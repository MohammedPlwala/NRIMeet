<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {

        $loginData['email'] = $request->email;
        $loginData['password'] = $request->password;
        $loginData['token'] = 'pbd2O23trmGRtc8QBgVk9LUP';

        $loginUrl = 'https://pbdindia.gov.in/apiv1/sso-login';

        $curl = curl_init($loginUrl);
        curl_setopt($curl, CURLOPT_URL, $loginUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
           "Accept: application/json",
        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // $data = json_encode($loginData);


        curl_setopt($curl, CURLOPT_POSTFIELDS, $loginData);
        

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result);
        echo "<pre>";
        print_r($result);
        die;

        
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        $credentials = ['email'=>$request->get('email'),'password'=>$request->get('password')];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = $user->getRoleNames()->toArray();
            
            if(!empty($role) && $role[0] == \Config::get('constants.ROLES.SUPERUSER')){
                return redirect('dashboard');
            }else{

                if(!empty($role) && $role[0] == \Config::get('constants.ROLES.BUYER')){
                    Auth::logout();
                    return redirect('login')->with('error', 'You are not allowed to access this portal.');
                }

                if(!empty($role) && $role[0] == \Config::get('constants.ROLES.SP')){
                    Auth::logout();
                    return redirect('login')->with('error', 'You are not allowed to access this portal.');
                }

                $organization = Organization::where('id',$user->organization_id)->where('status','active')->first();
                if(!$organization){
                    Auth::logout();
                    return redirect('login')->with('error', 'Opps! Your organization is not active');
                }elseif($organization->organization_type == 'MULTIPLE'){
                    return redirect()->intended('user/set-organization');    
                }
                return redirect()->intended('dashboard');
            }
            return redirect()->intended('dashboard');
        }else{
            $user = User::where('email',$request->get('email'))->first();
            if($user && !$user->status){
                return redirect('login')->with('error', 'Opps! Your account is not active');
            }
        }
        return redirect('login')->with('error', 'Opps! You have entered invalid credentials');
    }
}
