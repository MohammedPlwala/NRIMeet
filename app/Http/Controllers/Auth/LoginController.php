<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Modules\User\Entities\Role;
use Modules\User\Entities\UserRole;

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

    public function adminLogin(Request $request)
    {
        
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        $credentials = ['email'=>$request->get('email'),'password'=>$request->get('password'),'status' => 'active'];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $userRole = UserRole::select('r.name as role')->leftJoin('roles as r','user_role.role_id','=','r.id')->where('user_id',$user->id)->first();


            if($userRole->role == 'Guest'){
                Auth::logout();
                return redirect('admin/login')->with('error', 'You are not allowed to access this portal.');
            }
            \Session::put('role', $userRole->role);
            return redirect('admin/dashboard');
        }else{
            $user = User::where('email',$request->get('email'))->first();
            if($user && $user->status != "active"){
                return redirect('admin/login')->with('error', 'Opps! Your account is not active');
            }
        }
        return redirect('admin/login')->with('error', 'Opps! You have entered invalid credentials');
    }

    public function postLogin(Request $request)
    {

        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

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
        curl_setopt($curl, CURLOPT_POSTFIELDS, $loginData);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result);


        if(isset($result->resultflag) && $result->resultflag == 1){

            $userDetails = $result->details;

            $checkUser = User::where('email',$request->email)->first();
            if($checkUser){
                $credentials = ['email'=>$request->get('email'),'password'=>'123456'];
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
                }
            }else{
                $newUser = new User();
                $newUser->full_name = $userDetails->full_name;
                $newUser->email = $userDetails->email;
                $newUser->password = \Hash::make('123456');
                $newUser->gender = $userDetails->gender;
                $newUser->mobile = $userDetails->mobile;
                $newUser->address = $userDetails->address;
                $newUser->nationality = $userDetails->nationality;
                $newUser->country = $userDetails->country;
                $newUser->zip = $userDetails->zip;
                $newUser->identity_type = $userDetails->identity_type;
                $newUser->identity_number = $userDetails->identity_number;
                $newUser->date_of_birth = date('Y-m-d',strtotime($userDetails->date_of_birth));
                if($newUser->save()){
                    $credentials = ['email'=>$request->get('email'),'password'=>'123456'];
                    if (Auth::attempt($credentials)) {
                        $user = Auth::user();
                    }
                }else{
                    return redirect('/')->with('error', 'Invalid username or password');
                }
            }

            return redirect()->intended('/');

        }else{
            return redirect('/')->with('error', 'Invalid username or password');
        }

        echo "<pre>";
        print_r($result);
        die;

        
        
     
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
