<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('report')->group(function() {
    Route::get('/', 'ReportController@index');
    Route::get('sales-by-sales-person', 'ReportController@salesBySalesPerson');
    Route::get('export-sales-by-sales-person', 'ReportController@salesBySalesPersonExport');
    Route::get('sales-by-buyers', 'ReportController@salesByBuyers');
    Route::get('export-sales-by-buyers', 'ReportController@salesByBuyersExport');
    Route::get('top-10-products', 'ReportController@topProducts');
    Route::get('export-top-10-products', 'ReportController@topProductExport');
    Route::get('top-10-categories', 'ReportController@topCategories');
    Route::get('export-top-10-categories', 'ReportController@topCategoriesExport');
    Route::get('billing', 'ReportController@billing');
    Route::get('sales-by-product-categories', 'ReportController@salesByProductCategories');
    Route::get('export-sales-by-product-categories', 'ReportController@salesByProductCategoriesExport');
    Route::get('collection-report', 'ReportController@collectionReport');
    Route::get('zero-billing-sales-person', 'ReportController@zeroBillingSalesPerson');
    Route::get('export-zero-billing-sales-person', 'ReportController@zeroBillingSalesPersonExport');
    Route::get('zero-billing-buyers', 'ReportController@zeroBillingBuyers');
    Route::get('export-zero-billing-buyers', 'ReportController@zeroBillingBuyersExport');
    Route::get('target-achievement-buyers', 'ReportController@targetAchievementForBuyer');
    Route::get('target-achievement-sales-person', 'ReportController@targetchievementSetOfFieldTeam');

    Route::get('onfield-visits', 'ReportController@onfieldVisits');
    Route::get('offfield-visits', 'ReportController@offfieldVisits');

    Route::get('top-buyers', 'ReportController@topBuyers');
    Route::get('top-sales-person', 'ReportController@topSalesPerson');
    Route::get('zero-billing-items', 'ReportController@zeroBillingItems');
    Route::get('pending-sales-order', 'ReportController@pendingSalesOrder');
    
    Route::get('product-category-wise-sales-report', 'ReportController@productCategoryWiseSalesReport');
    Route::get('listed-price-vs-invoiced-price-report', 'ReportController@listedPriceVsInvoicedPriceReport');
    Route::get('stuff-role-report', 'ReportController@stuffRoleReport');
    Route::get('ticket-size-report', 'ReportController@ticketSizeReport');
    Route::get('billing-retailers-report', 'ReportController@billingRetailersReport');

    // Reports
    Route::get('guest', 'ReportController@guest');
    Route::get('hotel-master', 'ReportController@hotelMaster');
    Route::get('inventory', 'ReportController@inventory');
    Route::get('payment', 'ReportController@payment');
    Route::get('booking', 'ReportController@booking');
    Route::get('cancellation', 'ReportController@cancellation');
    Route::get('refund', 'ReportController@refund');

    Route::get('total-inventory-data', 'ReportController@totalInventoryData');
    Route::get('booking-summary', 'ReportController@bookingSummary');
    Route::get('group-bookings', 'ReportController@groupBookings');
    Route::get('call-center', 'ReportController@callCenter');
    Route::get('financial', 'ReportController@financial');
    Route::get('financial-2', 'ReportController@financial2');
});
