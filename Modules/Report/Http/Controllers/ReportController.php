<?php

namespace Modules\Report\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Modules\Saas\Entities\Organization;
use Modules\Ecommerce\Entities\Product;
use Modules\Ecommerce\Entities\Category;
use Modules\Ecommerce\Entities\ProductCategory;
use Modules\Ecommerce\Entities\Target;
use Modules\Ecommerce\Entities\Order;
use Modules\Ecommerce\Entities\Brand;
use Modules\Ecommerce\Entities\EcommerceModel;
use Modules\Ecommerce\Entities\OrderItem;
use Modules\User\Entities\User;
use Modules\User\Entities\State;
use Modules\User\Entities\City;
use Modules\User\Entities\District;
use URL;
use Auth;
use Modules\Ecommerce\Transformers\ProductPresenter;
use Helpers;
use Modules\Ecommerce\Transformers\OrderPresenter;
use Modules\Administration\Entities\NotificationTemplate;
use Image;
use Illuminate\Support\Str;
use DataTables;
use Yajra\DataTables\Services\DataTable;
use Modules\Report\Exports\SalesBySalesPersonExport;
use Modules\Report\Exports\SalesByBuyerExport;
use Modules\Report\Exports\TopProductExport;
use Modules\Report\Exports\TopCategoryExport;
use Modules\Report\Exports\SalesByProductCategoriesExport;
use Modules\Report\Exports\ZeroBillingSalesPersonExport;
use Modules\Report\Exports\ZeroBillingBuyersExport;
use Modules\Report\Exports\SalesPersonTargetAchievementExport;
use Modules\Report\Exports\BuyerTargetAchievementExport;
use Modules\Ecommerce\Entities\Visit;

class ReportController extends Controller
{

    public function __construct() {

        /* Execute authentication filter before processing any request */
        $this->middleware('auth');

        if (\Auth::check()) {
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('report::index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function salesBySalesPerson(Request $request)
    {
        $user = Auth::user();
        $organizationId=$user->organization_id;

        return view('report::sales_by_sales_person');
    }

    public function salesBySalesPersonExport(Request $request,$fileType = 'xls')
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        $orders =   Order::from('ecommerce_orders as o')
                    ->select('u.phone_number as user_mobile',
                        DB::Raw('sum(case when (oi.order_id!="") then 1 else 0 end) AS totalItems'),
                        DB::Raw('sum(o.amount) AS totalAmount'),
                        DB::Raw('sum(case when (o.id!="") then 1 else 0 end) AS totalOrders'),
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS username'),
                        DB::Raw('sum(case when (i.status="paid") then i.total else 0 end) AS amountInvoiced')
                    )
                    ->join('users as u','u.id','=','o.created_by')
                    ->join('ecommerce_order_items as oi','o.id','=','oi.order_id')
                    ->join('model_has_roles as mr','mr.model_id','=','u.id')
                    ->join('roles as r','r.id','=','mr.role_id')
                    ->leftJoin('accounts_invoices as i','o.id','=','i.order_id')
                    ->where('o.organization_id',$user->organization_id)
                    ->where('r.name',\Config::get('constants.ROLES.SP'))
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if(isset($request->month) && (!empty($request->month) ) ){
                                $query->whereMonth('o.created_at', $request->month);
                            }

                            if(isset($request->year) && (!empty($request->year) ) ){
                                $query->whereYear('o.created_at', $request->year);
                            }
                        }
                    })
                    ->orderBy('o.created_at','desc')
                    ->groupBy('o.created_by')
                    ->get()->toArray();

        $ordersData = array();
        if (!empty($orders)) {
            foreach ($orders as $key => $order) {
                $ordersData[] =    array(
                    'username'          => $order['username'],
                    'totalOrders'       => $order['totalOrders'],
                    'totalItems'        => $order['totalItems'],
                    'totalAmount'       => $order['totalAmount'],
                    'amountInvoiced'    => $order['amountInvoiced']
                );
            }


            $fileName = 'SalesBySalesPerson' . date('m-d-Y');

            if ($fileType == 'xlsx') {
                return (new SalesBySalesPersonExport($ordersData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            } elseif ($fileType == 'xls') {
                return (new SalesBySalesPersonExport($ordersData))->download($fileName . '.xls', \Maatwebsite\Excel\Excel::XLS);
            } elseif ($fileType == 'csv') {
                return (new SalesBySalesPersonExport($ordersData))->download($fileName . '.csv', \Maatwebsite\Excel\Excel::CSV, [
                    'Content-Type' => 'text/csv',
                ]);
            } else {
                return (new SalesBySalesPersonExport($ordersData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }

        } else {
            return redirect('report/sales-by-sales-person')->with('error', 'Orders not found');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function salesByBuyers(Request $request)
    {   
        $user = Auth::user();
        $organizationId=$user->organization_id;
        return view('report::sales_by_buyers');
    }

    public function salesByBuyersExport(Request $request,$fileType = 'xls')
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        $orders =   Order::from('ecommerce_orders as o')
                    ->select('u.phone_number as user_mobile',
                        DB::Raw('sum(case when (oi.order_id!="") then 1 else 0 end) AS totalItems'),
                        DB::Raw('sum(o.amount) AS totalAmount'),
                        DB::Raw('sum(case when (o.id!="") then 1 else 0 end) AS totalOrders'),
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS username'),
                        DB::Raw('sum(case when (i.status="paid") then i.total else 0 end) AS amountInvoiced')
                    )
                    ->join('users as u','u.id','=','o.created_by')
                    ->join('ecommerce_order_items as oi','o.id','=','oi.order_id')
                    ->join('model_has_roles as mr','mr.model_id','=','u.id')
                    ->join('roles as r','r.id','=','mr.role_id')
                    ->leftJoin('accounts_invoices as i','o.id','=','i.order_id')
                    ->where('o.organization_id',$user->organization_id)
                    ->where('r.name',\Config::get('constants.ROLES.BUYER'))
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if(isset($request->month) && (!empty($request->month) ) ){
                                $query->whereMonth('o.created_at', $request->month);
                            }

                            if(isset($request->year) && (!empty($request->year) ) ){
                                $query->whereYear('o.created_at', $request->year);
                            }
                        }
                    })
                    ->orderBy('o.created_at','desc')
                    ->groupBy('o.created_by')
                    ->get()->toArray();

        $ordersData = array();
        if (!empty($orders)) {
            foreach ($orders as $key => $order) {
                $ordersData[] =    array(
                    'username'          => $order['username'],
                    'totalOrders'       => $order['totalOrders'],
                    'totalItems'        => $order['totalItems'],
                    'totalAmount'       => $order['totalAmount'],
                    'amountInvoiced'    => $order['amountInvoiced']
                );
            }


            $fileName = 'SalesByBuyer' . date('m-d-Y');

            if ($fileType == 'xlsx') {
                return (new SalesByBuyerExport($ordersData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            } elseif ($fileType == 'xls') {
                return (new SalesByBuyerExport($ordersData))->download($fileName . '.xls', \Maatwebsite\Excel\Excel::XLS);
            } elseif ($fileType == 'csv') {
                return (new SalesByBuyerExport($ordersData))->download($fileName . '.csv', \Maatwebsite\Excel\Excel::CSV, [
                    'Content-Type' => 'text/csv',
                ]);
            } else {
                return (new SalesByBuyerExport($ordersData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }

        } else {
            return redirect('report/sales-by-buyers')->with('error', 'Orders not found');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function topProducts(Request $request)
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        return view('report::top_10_products');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function topProductExport(Request $request,$fileType = 'xls')
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        $products = Product::from('ecommerce_products as p')
                        ->select('p.id','p.created_at','p.organization_id','p.name','p.status','s.sale_price as price','s.code as sku_code','b.name as brand',
                            DB::raw('group_concat(DISTINCT cat.name) as categories'),
                            DB::Raw('SUM(quantity) AS TotalQuantity')
                        )
                        ->leftJoin('ecommerce_category_product as pro_cat','pro_cat.product_id','=','p.id')
                        ->leftJoin('categories as cat','cat.id','=','pro_cat.category_id')
                        ->leftJoin('ecommerce_sku as s','s.product_id','=','p.id')
                        ->join('ecommerce_order_items as oi','oi.sku_code','=','s.code')
                        ->leftJoin('ecommerce_product_brand as pb','pb.product_id','=','p.id')
                        ->leftJoin('ecommerce_brands as b','b.id','=','pb.brand_id')
                        ->where('p.organization_id',$organizationId)
                        ->whereNull('p.deleted_at')
                        ->groupBy('oi.sku_code')
                        ->orderBy('TotalQuantity','desc')
                        ->take(10)
                        ->get()->toArray();


        $productData = array();
        if (!empty($products)) {
            foreach ($products as $key => $product) {
                $productData[] =    array(
                    'name'          => $product['name'],
                    'price'         => $product['price'],
                    'brand'         => $product['brand'],
                    'categories'    => $product['categories'],
                    'status'        => $product['status'],
                    'created_at'    => date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($product['created_at']))
                );
            }


            $fileName = 'TopProduct-' . date('m-d-Y');

            if ($fileType == 'xlsx') {
                return (new TopProductExport($productData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            } elseif ($fileType == 'xls') {
                return (new TopProductExport($productData))->download($fileName . '.xls', \Maatwebsite\Excel\Excel::XLS);
            } elseif ($fileType == 'csv') {
                return (new TopProductExport($productData))->download($fileName . '.csv', \Maatwebsite\Excel\Excel::CSV, [
                    'Content-Type' => 'text/csv',
                ]);
            } else {
                return (new TopProductExport($productData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }

        } else {
            return redirect('report/top-10-products')->with('error', 'Products not found');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function topCategories(Request $request)
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        return view('report::top_10_categories');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function topCategoriesExport(Request $request,$fileType = 'xls')
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        $categories =   ProductCategory::from('ecommerce_category_product as cp')
                        ->select('c.name','c.created_at','c.updated_at','pc.name as parent','c.status','c.parent_id',
                            DB::Raw('sum(case when (cp.product_id!="") then 1 else 0 end) AS totalProducts'),
                            DB::Raw('SUM(quantity) AS TotalQuantity')
                        )
                        ->leftJoin('categories as c','c.id','=','cp.category_id')
                        ->leftJoin('categories as pc','pc.id','=','c.parent_id')
                        ->leftJoin('ecommerce_sku as s','s.product_id','=','cp.product_id')
                        ->join('ecommerce_order_items as oi','oi.sku_code','=','s.code')
                        ->where('c.organization_id',$organizationId)
                        ->groupBy('cp.category_id')
                        ->orderBy('TotalQuantity','desc')
                        ->take(10)
                        ->get()->toArray();

        $categoryData = array();
        if (!empty($categories)) {
            foreach ($categories as $key => $category) {
                $categoryData[] =    array(
                    'name'          => $category['name'],
                    'parent'         => $category['parent'],
                    'totalProducts'         => $category['totalProducts'],
                    'status'        => $category['status'],
                    'created_at'    => date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($category['created_at'])),
                    'updated_at'    => date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($category['updated_at'])),
                );
            }


            $fileName = 'TopCategories-' . date('m-d-Y');

            if ($fileType == 'xlsx') {
                return (new TopCategoryExport($categoryData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            } elseif ($fileType == 'xls') {
                return (new TopCategoryExport($categoryData))->download($fileName . '.xls', \Maatwebsite\Excel\Excel::XLS);
            } elseif ($fileType == 'csv') {
                return (new TopCategoryExport($categoryData))->download($fileName . '.csv', \Maatwebsite\Excel\Excel::CSV, [
                    'Content-Type' => 'text/csv',
                ]);
            } else {
                return (new TopCategoryExport($categoryData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }

        } else {
            return redirect('report/top-10-categories')->with('error', 'Categories not found');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function billing()
    {
        return view('report::billing');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function salesByProductCategories(Request $request)
    {
        $user = Auth::user();
        $organizationId=$user->organization_id;

        $categories =   ProductCategory::from('ecommerce_category_product as cp')
                        ->select('c.id','c.name','c.created_at','c.updated_at','c.status','c.parent_id',
                            DB::Raw('sum(case when (o.id!="") then 1 else 0 end) AS totalOrders'),
                            DB::Raw('sum(o.amount) AS orderAmount'),
                            DB::Raw('sum(case when (i.status="paid") then i.total else 0 end) AS amountInvoiced')
                        )
                        ->leftJoin('categories as c','c.id','=','cp.category_id')
                        ->leftJoin('ecommerce_sku as s','s.product_id','=','cp.product_id')
                        ->join('ecommerce_order_items as oi','oi.sku_code','=','s.code')
                        ->join('ecommerce_orders as o','oi.order_id','=','o.id')
                        ->leftJoin('accounts_invoices as i','o.id','=','i.order_id')
                        ->where('c.organization_id',$organizationId)
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if(isset($request->category) && (!empty($request->category) ) ){
                                    $query->whereMonth('c.id', $request->category);
                                }

                                if(isset($request->range) && (!empty($request->range) ) ){
                                    if($request->range == '7days'){
                                        $query->whereDate('o.created_at', \Carbon\Carbon::now()->subDays(7));
                                    }elseif($request->range == '30days'){
                                        $query->whereDate('o.created_at', \Carbon\Carbon::now()->subDays(30));
                                    }elseif($request->range == 'current_month'){
                                        $query->whereMonth('o.created_at', date('m'));
                                    }elseif($request->range == 'last_month'){
                                        $query->whereMonth('o.created_at', \Carbon\Carbon::now()->subMonth()->month);   
                                    }elseif ($request->range == 'current_quarter') {
                                        $dates = Helpers:: get_dates_of_quarter($quarter = 'current', $year = null, $format = 'Y-m-d');

                                        $dateFrom =  \Carbon\Carbon::createFromFormat('Y-m-d', $dates['startDate'])->format('Y-m-d');
                                        $dateTo =  \Carbon\Carbon::createFromFormat('Y-m-d', $dates['endDate'])->format('Y-m-d');

                                        $dateTo = date('Y-m-d', strtotime($dateTo . ' +1 day'));
                                        $query->whereBetween('o.created_at', array($dateFrom, $dateTo));
                                    }
                                    elseif ($request->range == 'last_quarter') {
                                        $dates = Helpers:: get_dates_of_quarter($quarter = 'previous', $year = null, $format = 'Y-m-d');

                                        $dateFrom =  \Carbon\Carbon::createFromFormat('Y-m-d', $dates['startDate'])->format('Y-m-d');
                                        $dateTo =  \Carbon\Carbon::createFromFormat('Y-m-d', $dates['endDate'])->format('Y-m-d');

                                        $dateTo = date('Y-m-d', strtotime($dateTo . ' +1 day'));
                                        $query->whereBetween('o.created_at', array($dateFrom, $dateTo));
                                    }

                                }

                                if (isset($request->dateFrom) || isset($request->dateTo)) {

                                    if (isset($request->dateFrom) && isset($request->dateTo)) {

                                        $dateFrom =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->input("dateFrom"))->format('Y-m-d');
                                        $dateTo =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->input("dateTo"))->format('Y-m-d');

                                        $dateTo = date('Y-m-d', strtotime($dateTo . ' +1 day'));
                                        $query->whereBetween('o.created_at', array($dateFrom, $dateTo));
                                    } elseif (isset($request->dateFrom)) {
                                        $dateFrom =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->input("dateFrom"))->format('Y-m-d');
                                        $query->whereDate('o.created_at', '>=', $dateFrom);
                                    } elseif (isset($request->dateTo)) {
                                        $dateTo =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->input("dateTo"))->format('Y-m-d');
                                        $query->whereDate('o.created_at', '<=', $dateTo);
                                    }
                                }
                            }
                        })
                        ->groupBy('c.id')
                        ->get();

        return view('report::sales_by_product_categories',['categories'=>$categories]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function salesByProductCategoriesExport(Request $request,$fileType = 'xls')
    {
        $user = Auth::user();
        $organizationId=$user->organization_id;

        $categories =   ProductCategory::from('ecommerce_category_product as cp')
                        ->select('c.id','c.name','c.created_at','c.updated_at','c.status','c.parent_id',
                            DB::Raw('sum(case when (o.id!="") then 1 else 0 end) AS totalOrders'),
                            DB::Raw('sum(o.amount) AS orderAmount'),
                            DB::Raw('sum(case when (i.status="paid") then i.total else 0 end) AS amountInvoiced')
                        )
                        ->leftJoin('categories as c','c.id','=','cp.category_id')
                        ->leftJoin('ecommerce_sku as s','s.product_id','=','cp.product_id')
                        ->join('ecommerce_order_items as oi','oi.sku_code','=','s.code')
                        ->join('ecommerce_orders as o','oi.order_id','=','o.id')
                        ->leftJoin('accounts_invoices as i','o.id','=','i.order_id')
                        ->where('c.organization_id',$organizationId)
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if(isset($request->category) && (!empty($request->category) ) ){
                                    $query->whereMonth('c.id', $request->category);
                                }

                                if(isset($request->range) && (!empty($request->range) ) ){
                                    if($request->range == '7days'){
                                        $query->whereDate('o.created_at', \Carbon\Carbon::now()->subDays(7));
                                    }elseif($request->range == '30days'){
                                        $query->whereDate('o.created_at', \Carbon\Carbon::now()->subDays(30));
                                    }elseif($request->range == 'current_month'){
                                        $query->whereMonth('o.created_at', date('m'));
                                    }elseif($request->range == 'last_month'){
                                        $query->whereMonth('o.created_at', \Carbon\Carbon::now()->subMonth()->month);   
                                    }elseif ($request->range == 'current_quarter') {
                                        $dates = Helpers:: get_dates_of_quarter($quarter = 'current', $year = null, $format = 'Y-m-d');

                                        $dateFrom =  \Carbon\Carbon::createFromFormat('Y-m-d', $dates['startDate'])->format('Y-m-d');
                                        $dateTo =  \Carbon\Carbon::createFromFormat('Y-m-d', $dates['endDate'])->format('Y-m-d');

                                        $dateTo = date('Y-m-d', strtotime($dateTo . ' +1 day'));
                                        $query->whereBetween('o.created_at', array($dateFrom, $dateTo));
                                    }
                                    elseif ($request->range == 'last_quarter') {
                                        $dates = Helpers:: get_dates_of_quarter($quarter = 'previous', $year = null, $format = 'Y-m-d');

                                        $dateFrom =  \Carbon\Carbon::createFromFormat('Y-m-d', $dates['startDate'])->format('Y-m-d');
                                        $dateTo =  \Carbon\Carbon::createFromFormat('Y-m-d', $dates['endDate'])->format('Y-m-d');

                                        $dateTo = date('Y-m-d', strtotime($dateTo . ' +1 day'));
                                        $query->whereBetween('o.created_at', array($dateFrom, $dateTo));
                                    }

                                }

                                if (isset($request->dateFrom) || isset($request->dateTo)) {

                                    if (isset($request->dateFrom) && isset($request->dateTo)) {

                                        $dateFrom =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->input("dateFrom"))->format('Y-m-d');
                                        $dateTo =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->input("dateTo"))->format('Y-m-d');

                                        $dateTo = date('Y-m-d', strtotime($dateTo . ' +1 day'));
                                        $query->whereBetween('o.created_at', array($dateFrom, $dateTo));
                                    } elseif (isset($request->dateFrom)) {
                                        $dateFrom =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->input("dateFrom"))->format('Y-m-d');
                                        $query->whereDate('o.created_at', '>=', $dateFrom);
                                    } elseif (isset($request->dateTo)) {
                                        $dateTo =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->input("dateTo"))->format('Y-m-d');
                                        $query->whereDate('o.created_at', '<=', $dateTo);
                                    }
                                }
                            }
                        })
                        ->groupBy('c.id')
                        ->get();

        $categoryData = array();
        if (!empty($categories)) {
            foreach ($categories as $key => $category) {
                $categoryData[] =    array(
                    'name'          => $category['name'],
                    'totalOrders' => $category['totalOrders'],
                    'orderAmount'        => $category['orderAmount'],
                    'amountInvoiced'        => $category['amountInvoiced']
                );
            }


            $fileName = 'SalesByProductCategories-' . date('m-d-Y');

            if ($fileType == 'xlsx') {
                return (new SalesByProductCategoriesExport($categoryData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            } elseif ($fileType == 'xls') {
                return (new SalesByProductCategoriesExport($categoryData))->download($fileName . '.xls', \Maatwebsite\Excel\Excel::XLS);
            } elseif ($fileType == 'csv') {
                return (new SalesByProductCategoriesExport($categoryData))->download($fileName . '.csv', \Maatwebsite\Excel\Excel::CSV, [
                    'Content-Type' => 'text/csv',
                ]);
            } else {
                return (new SalesByProductCategoriesExport($categoryData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }

        } else {
            return redirect('report/sales-by-buyers')->with('error', 'Products not found');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function collectionReport()
    {
        return view('report::collection_report');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function zeroBillingSalesPerson(Request $request)
    {
        $user = Auth::user();
        $organizationId=$user->organization_id;

        $users =   User::from('users as u')
                    ->select('u.id','u.phone_number as user_mobile','u.email','u.file','u.phone_number','u.created_at','u.updated_at','u.status',
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS username'),
                        DB::Raw('sum(case when (o.created_by!="") then 1 else 0 end) AS totalOrders'),
                    )
                    ->leftJoin('ecommerce_orders as o','u.id','=','o.created_by')
                    ->leftJoin('model_has_roles as mr','mr.model_id','=','u.id')
                    ->leftJoin('roles as r','r.id','=','mr.role_id')
                    ->where('u.organization_id',$user->organization_id)
                    ->where('r.name',\Config::get('constants.ROLES.SP'))
                    ->groupBy('u.id')
                    ->having('totalOrders', '<', 1)
                    ->get();


        if ($request->ajax()) {
            return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('name', function($row) {

                    if(isset($userPermission['buyer']) && ($userPermission['buyer']['read_all'])){
                        $detailLink = url('user/detail/'.$row->id);
                    }else{
                        $detailLink = '#';
                    }

                    if(!is_null($row->file)){
                        $file = public_path('uploads/users/') . $row->file;
                    }

                    if(!is_null($row->file) && file_exists($file))
                        $avatar = "<img src=".url('uploads/users/'.$row->file).">";
                    else
                        $avatar = "<span>".\Helpers::getAcronym($row->username)."</span>";
                    

                    $name = '
                                <a href="'.$detailLink.'">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary">
                                            '.$avatar.'
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">'.ucfirst($row->username).' <span class="dot dot-success d-md-none ml-1"></span></span>
                                            <span>'.$row->email.' </span>
                                        </div>
                                    </div>
                                </a>
                            ';
                    return $name;
            })
            ->addColumn('created_at', function ($row) {
                        return date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->created_at));
                    })
            ->addColumn('updated_at', function ($row) {
                return date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->updated_at));
            })
            ->addColumn('status', function ($row) {
                if($row->status == 1){
                    $statusValue = 'Approved';
                }else{
                    $statusValue = 'Not Approved';
                }

                $value = ($row->status == '1') ? 'badge badge-success' : 'badge badge-danger';
                $status = '
                    <span class="tb-sub">
                        <span class="'.$value.'">
                            '.$statusValue.'
                        </span>
                    </span>
                ';
                return $status;
            })
            ->rawColumns(['created_at','name','updated_at','status'])
            ->make(true);
        }
        return view('report::zero_billing_sales_person',['users' => $users]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function ZeroBillingSalesPersonExport(Request $request,$fileType = 'xls')
    {
        $user = Auth::user();
        $organizationId=$user->organization_id;

        $users =   User::from('users as u')
                    ->select('u.id','u.phone_number as user_mobile','u.email','u.file','u.phone_number','u.created_at','u.updated_at','u.status',
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS username'),
                        DB::Raw('sum(case when (o.created_by!="") then 1 else 0 end) AS totalOrders'),
                    )
                    ->leftJoin('ecommerce_orders as o','u.id','=','o.created_by')
                    ->leftJoin('model_has_roles as mr','mr.model_id','=','u.id')
                    ->leftJoin('roles as r','r.id','=','mr.role_id')
                    ->where('u.organization_id',$user->organization_id)
                    ->where('r.name',\Config::get('constants.ROLES.SP'))
                    ->groupBy('u.id')
                    ->having('totalOrders', '<', 1)
                    ->get();

        $userData = array();
        if (!empty($users)) {
            foreach ($users as $key => $user) {

                $status = ($user['status'] == '1') ? 'Approved' : 'Not Approved';

                $userData[] =    array(
                    'username'          => ucfirst($user['username']),
                    'email'          => $user['email'],
                    'status'          => $status,
                    'user_mobile'          => $user['user_mobile'],
                    'created_at'    => date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($user['created_at'])),
                    'updated_at'    => date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($user['updated_at']))
                    
                );
            }


            $fileName = 'ZeroBillingSalesPerson' . date('m-d-Y');

            if ($fileType == 'xlsx') {
                return (new ZeroBillingSalesPersonExport($userData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            } elseif ($fileType == 'xls') {
                return (new ZeroBillingSalesPersonExport($userData))->download($fileName . '.xls', \Maatwebsite\Excel\Excel::XLS);
            } elseif ($fileType == 'csv') {
                return (new ZeroBillingSalesPersonExport($userData))->download($fileName . '.csv', \Maatwebsite\Excel\Excel::CSV, [
                    'Content-Type' => 'text/csv',
                ]);
            } else {
                return (new ZeroBillingSalesPersonExport($userData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }

        } else {
            return redirect('report/zero-billing-sales-person')->with('error', 'Orders not found');
        }

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function zeroBillingBuyers(Request $request)
    {
        $user = Auth::user();
        $organizationId=$user->organization_id;

        $users =   User::from('users as u')
                    ->select('u.id','u.phone_number as user_mobile','u.email','u.file','u.phone_number','u.created_at','u.updated_at','ob.status',
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS username'),
                        DB::Raw('sum(case when (o.created_by!="") then 1 else 0 end) AS totalOrders'),
                    )
                    ->leftJoin('ecommerce_orders as o','u.id','=','o.user_id')
                    ->leftJoin('organization_buyer as ob','u.id','=','ob.buyer_id')
                    ->leftJoin('model_has_roles as mr','mr.model_id','=','u.id')
                    ->leftJoin('roles as r','r.id','=','mr.role_id')
                    ->where('ob.organization_id',$user->organization_id)
                    ->where('r.name',\Config::get('constants.ROLES.BUYER'))
                    ->groupBy('u.id')
                    ->having('totalOrders', '<', 1)
                    ->get();

        if ($request->ajax()) {
            return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('name', function($row) {

                    if(isset($userPermission['buyer']) && ($userPermission['buyer']['read_all'])){
                        $detailLink = url('user/detail/'.$row->id);
                    }else{
                        $detailLink = '#';
                    }

                    if(!is_null($row->file)){
                        $file = public_path('uploads/users/') . $row->file;
                    }

                    if(!is_null($row->file) && file_exists($file))
                        $avatar = "<img src=".url('uploads/users/'.$row->file).">";
                    else
                        $avatar = "<span>".\Helpers::getAcronym($row->username)."</span>";
                    

                    $name = '
                                <a href="'.$detailLink.'">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary">
                                            '.$avatar.'
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">'.ucfirst($row->username).' <span class="dot dot-success d-md-none ml-1"></span></span>
                                            <span>'.$row->email.' </span>
                                        </div>
                                    </div>
                                </a>
                            ';
                    return $name;
            })
            ->addColumn('created_at', function ($row) {
                        return date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->created_at));
                    })
            ->addColumn('updated_at', function ($row) {
                return date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->updated_at));
            })
            ->addColumn('status', function ($row) {
                if($row->status == 1){
                    $statusValue = 'Approved';
                }else{
                    $statusValue = 'Not Approved';
                }

                $value = ($row->status == '1') ? 'badge badge-success' : 'badge badge-danger';
                $status = '
                    <span class="tb-sub">
                        <span class="'.$value.'">
                            '.$statusValue.'
                        </span>
                    </span>
                ';
                return $status;
            })
            ->rawColumns(['created_at','name','updated_at','status'])
            ->make(true);
        }

        $states             =   State::all();
        $districts          =   District::where('state_id',$user->state)->orderby('name','asc')->get();
        $cities             =   City::where('district_id',$user->district)->orderby('name','asc')->get();
        
        return view('report::zero_billing_buyers',['users' => $users,'states'=>$states,'districts'=>$districts,'cities'=>$cities]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function zeroBillingBuyersExport(Request $request,$fileType = 'xls')
    {
        $user = Auth::user();
        $organizationId=$user->organization_id;

        $users =   User::from('users as u')
                    ->select('u.id','u.phone_number as user_mobile','u.email','u.file','u.phone_number','u.created_at','u.updated_at','ob.status',
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS username'),
                        DB::Raw('sum(case when (o.created_by!="") then 1 else 0 end) AS totalOrders'),
                    )
                    ->leftJoin('ecommerce_orders as o','u.id','=','o.user_id')
                    ->leftJoin('organization_buyer as ob','u.id','=','ob.buyer_id')
                    ->leftJoin('model_has_roles as mr','mr.model_id','=','u.id')
                    ->leftJoin('roles as r','r.id','=','mr.role_id')
                    ->where('ob.organization_id',$user->organization_id)
                    ->where('r.name',\Config::get('constants.ROLES.BUYER'))
                    ->groupBy('u.id')
                    ->having('totalOrders', '<', 1)
                    ->get();

        $userData = array();
        if (!empty($users)) {
            foreach ($users as $key => $user) {

                $status = ($user['status'] == '1') ? 'Approved' : 'Not Approved';

                $userData[] =    array(
                    'username'          => ucfirst($user['username']),
                    'email'          => $user['email'],
                    'status'          => $status,
                    'user_mobile'          => $user['user_mobile'],
                    'created_at'    => date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($user['created_at'])),
                    'updated_at'    => date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($user['updated_at']))
                    
                );
            }


            $fileName = 'ZeroBillingBuyers' . date('m-d-Y');

            if ($fileType == 'xlsx') {
                return (new ZeroBillingBuyersExport($userData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            } elseif ($fileType == 'xls') {
                return (new ZeroBillingBuyersExport($userData))->download($fileName . '.xls', \Maatwebsite\Excel\Excel::XLS);
            } elseif ($fileType == 'csv') {
                return (new ZeroBillingBuyersExport($userData))->download($fileName . '.csv', \Maatwebsite\Excel\Excel::CSV, [
                    'Content-Type' => 'text/csv',
                ]);
            } else {
                return (new ZeroBillingBuyersExport($userData))->download($fileName . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }

        } else {
            return redirect('report/zero-billing-buyers')->with('error', 'Buyers not found');
        }

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function targetAchievementForBuyer(Request $request)
    {

        $user = Auth::user();
        $targets =  Target::from('targets as t')
                    ->select('t.user_id','t.month','t.year','t.total_sales','t.total_line_items','t.total_orders','s.name as state','c.name as city','d.name as district',
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS username'),
                        DB::Raw('sum(case when (o.user_id!="") then 1 else 0 end) AS achivedOrders'),
                        DB::Raw('sum(case when (o.user_id!="") then o.amount else 0 end) AS achivedSales'),
                        DB::Raw('sum(case when (oi.order_id!="") then 1 else 0 end) AS achivedItems')
                    )
                    ->join('users as u','u.id','=','t.user_id')
                    ->join('model_has_roles as mr','mr.model_id','=','u.id')
                    ->join('roles as r','mr.role_id','=','r.id')
                    ->leftJoin('ecommerce_orders as o','u.id','=','o.user_id')
                    ->leftJoin('ecommerce_order_items as oi','o.id','=','oi.order_id')
                    ->leftJoin('states as s','s.id','=','u.state')
                    ->leftJoin('cities as c','c.id','=','u.city')
                    ->leftJoin('districts as d','d.id','=','u.district')
                    ->where('r.name',\Config::get('constants.ROLES.BUYER'))
                    ->where('t.organization_id',$user->organization_id)

                    ->where(function ($query) use ($request) {
                        if(isset($request->month) || isset($request->year) || isset($request->buyer)|| isset($request->state)|| isset($request->district) || isset($request->city)) {
                            $this->targetFilters($request, $query);
                        }else{
                            $query->where('t.month',date('m'));
                            $query->where('t.year',date('Y'));
                            $query->whereMonth('o.created_at',date('m'));
                            $query->whereYear('o.created_at',date('Y'));
                        }
                    })

                    ->groupBy('u.id')
                    ->get();

        if(isset($request->month)){
            $period = date('F-Y',strtotime($request->year.'-'.$request->month.'-01'));
            $note = 'Showing results for '.$period;
        }else{
            $period = date('F-Y');
            $note = 'Showing results for '.$period;
        }

        if ($request->ajax()) {
            return Datatables::of($targets)
            ->addIndexColumn()
            ->addColumn('username', function ($row) {
                $username = ucfirst($row->username);
                return $username;
            })
            ->addColumn('period', function ($row) {
                $month = date('F',strtotime('2020-'.$row->month.'-01'));
                return $month.'-'.$row->year;
            })
            ->make(true);
        }

        $states             =   State::all();
        $districts          =   District::where('state_id',$user->state)->orderby('name','asc')->get();
        $cities             =   City::where('district_id',$user->district)->orderby('name','asc')->get();


        return view('report::target_achievement_set_for_retailers', ['note'=>$note,'states'=>$states,'districts'=>$districts,'cities'=>$cities,'targets'=>$targets]);
    }

    public function targetFilters(Request $request,$query)
    {
        if (isset($request->month)) {
            $query->where('t.month',$request->month);
        }

        if (isset($request->year)) {
            $query->where('t.year',$request->year);
        }

        if (isset($request->buyer)) {
            $query->where('t.user_id',$request->buyer);
        }

        if (isset($request->salesPerson)) {
            $query->where('t.user_id',$request->salesPerson);
        }

        if (isset($request->state)) {
            $query->where('u.state',$request->state);
        }

        if (isset($request->district)) {
            $query->where('u.district',$request->district);
        }

        if (isset($request->city)) {
            $query->where('u.city',$request->city);
        }

        return $query;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function targetchievementSetOfFieldTeam(Request $request)
    {

        $user = Auth::user();
        $targets =  Target::from('targets as t')
                    ->select('t.user_id','t.month','t.year','t.total_sales','t.total_line_items','t.total_orders','s.name as state','c.name as city','d.name as district',
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS username'),
                        DB::Raw('sum(case when (o.created_by!="") then 1 else 0 end) AS achivedOrders'),
                        DB::Raw('sum(case when (o.created_by!="") then o.amount else 0 end) AS achivedSales'),
                        DB::Raw('sum(case when (oi.order_id!="") then 1 else 0 end) AS achivedItems')
                    )
                    ->join('users as u','u.id','=','t.user_id')
                    ->join('model_has_roles as mr','mr.model_id','=','u.id')
                    ->join('roles as r','mr.role_id','=','r.id')
                    ->leftJoin('ecommerce_orders as o','u.id','=','o.created_by')
                    ->leftJoin('ecommerce_order_items as oi','o.id','=','oi.order_id')
                    ->leftJoin('states as s','s.id','=','u.state')
                    ->leftJoin('cities as c','c.id','=','u.city')
                    ->leftJoin('districts as d','d.id','=','u.district')
                    ->where('r.name',\Config::get('constants.ROLES.SP'))
                    ->where('t.organization_id',$user->organization_id)

                    ->where(function ($query) use ($request) {
                        if(isset($request->month) || isset($request->year) || isset($request->salesPerson)|| isset($request->state)|| isset($request->district) || isset($request->city)) {
                            $this->targetFilters($request, $query);
                        }else{
                            $query->where('t.month',date('m'));
                            $query->where('t.year',date('Y'));
                            $query->whereMonth('o.created_at',date('m'));
                            $query->whereYear('o.created_at',date('Y'));
                        }
                    })

                    ->groupBy('u.id')
                    ->get();

        if(isset($request->month)){
            $period = date('F-Y',strtotime($request->year.'-'.$request->month.'-01'));
            $note = 'Showing results for '.$period;
        }else{
            $period = date('F-Y');
            $note = 'Showing results for '.$period;
        }

        if ($request->ajax()) {
            return Datatables::of($targets)
            ->addIndexColumn()
            ->addColumn('username', function ($row) {
                $username = ucfirst($row->username);
                return $username;
            })
            ->addColumn('period', function ($row) {
                $month = date('F',strtotime('2020-'.$row->month.'-01'));
                return $month.'-'.$row->year;
            })
            ->make(true);
        }

        $states             =   State::all();
        $districts          =   District::where('state_id',$user->state)->orderby('name','asc')->get();
        $cities             =   City::where('district_id',$user->district)->orderby('name','asc')->get();

        return view('report::target_achievement_set_of_field_team', ['note'=>$note,'states'=>$states,'districts'=>$districts,'cities'=>$cities,'targets'=>$targets]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function productCategoryWiseSalesReport()
    {
        return view('report::product_category_wise_sales_report');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function listedPriceVsInvoicedPriceReport()
    {
        return view('report::listed_price_vs_invoiced_price_report');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function stuffRoleReport()
    {
        return view('report::stuff_role_report');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function ticketSizeReport()
    {
        return view('report::ticket_size_report');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function billingRetailersReport()
    {
        return view('report::billing_retailers_report');
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function topBuyers(Request $request)
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        return view('report::top_buyers');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function topSalesPerson(Request $request)
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        return view('report::top_sales_person');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function zeroBillingItems(Request $request)
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;
        $brands = Brand::where('status','active')->where('organization_id',$organizationId)->whereNull('deleted_at')->get();
        $categories = Category::where('status','active')->where('organization_id',$organizationId)->whereNull('deleted_at')->get();
        $models = EcommerceModel::where('status','active')->where('organization_id',$organizationId)->whereNull('deleted_at')->get();
        return view('report::zero_billing_items',['brands'=>$brands,'categories'=>$categories,'models'=>$models]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function pendingSalesOrder(Request $request)
    {

        $user = Auth::user();
        $organizationId=$user->organization_id;

        return view('report::pending_sales_order');
    }

    public function onfieldVisits(Request $request)
    {
        $user = Auth::user();
        $buyers =   Visit::from('visits as v')
                    ->select('v.buyer',DB::Raw('CONCAT(r.name," ", r.last_name) AS buyerName'))
                    ->leftJoin('users as r','r.id','=','v.buyer')
                    ->where('v.plan_type','ONFIELD')
                    ->distinct()
                    ->get();

        $dsps =     Visit::from('visits as v')
                    ->select('v.dsp',DB::Raw('CONCAT(r.name," ", r.last_name) AS dspName'))
                    ->leftJoin('users as r','r.id','=','v.dsp')
                    ->where('v.plan_type','ONFIELD')
                    ->distinct()
                    ->get();

        return view('report::on_field_visit',['dsps'=>$dsps,'buyers'=>$buyers]);
    }

    public function offfieldVisits(Request $request)
    {
        $user = Auth::user();
        $dsps =     Visit::from('visits as v')
                    ->select('v.dsp',DB::Raw('CONCAT(r.name," ", r.last_name) AS dspName'))
                    ->leftJoin('users as r','r.id','=','v.dsp')
                    ->where('v.plan_type','OFFFIELD')
                    ->distinct()
                    ->get();
        return view('report::off_field_visit',['dsps'=>$dsps]);
    }
}
