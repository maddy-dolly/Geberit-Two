<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

    // Users
    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
    Route::post('status/{id}', 'UserController@status');
    Route::post('userdelete', 'UserController@deleteAll');
    Route::post('update/{id}', 'AuthController@update');
    Route::post('forgotpasswordemailsending', 'UserController@forgotEmailSending');
    Route::post('forgotpassword', 'UserController@forgotPassword');

    


    //customer
    Route::post('addcustomer','CustomerController@add');
    Route::post('addallcustomer','CustomerController@addAll');
    Route::get('customer/{id}','CustomerController@show');
    Route::get('customer','CustomerController@showall');
    Route::get('deletecustomer/{id}','CustomerController@delete');
    Route::post('customerbulkdelete', 'CustomerController@deleteAll');
    Route::post('updatecustomer/{id}', 'CustomerController@updateCustomer');

    //quotation controller
    Route::get('usercustomer/{id}','QuotationController@userCustomer');
    Route::post('addquotation','QuotationController@addQuotation');
    Route::get('quotationlist/{id}','QuotationController@quotationList');
    Route::get('quotationsingle/{id}','QuotationController@showSingleQuotation');
    Route::get('quotationsingle/{id}/{ref_no}','QuotationController@showQuotation');
    Route::post('updatequotation/{id}','QuotationController@updateQuotation');
    Route::get('quotationdelete/{id}','QuotationController@quotationSoftDelete');
    Route::get('quotationexcel/{id}','QuotationController@Export');
    Route::get('quotation/sales/pdf/{id}','QuotationController@Pdf');
    Route::get('quotation/user/pdf/{id}','QuotationController@PdfUser');
    Route::post('approvequotation/{id}','QuotationController@acceptQuotation');
    Route::post('rejectquotation/{id}','QuotationController@rejectQuotation');

    //Report routes
    Route::get('userreport/{id}', 'ReportController@reportUser');
    Route::any('projectreport/{id}/{role_id}', 'ReportController@projectReport');
    Route::any('retailreport/{id}/{role_id}', 'ReportController@retailReport');
    Route::get('quotationreport/{id}', 'ReportController@reportQuotation');
    Route::any('projectexcel/{id}/{role_id}/{user}/{currency}/{from}/{to}', 'ReportController@projectReportExport');
    Route::any('retailexcel/{id}/{role_id}/{user}/{currency}/{from}/{to}', 'ReportController@retailReportExport');
    Route::any('project-pl-report/{id}/{role_id}', 'ReportController@projectPLReport');
    Route::any('retail-pl-report/{id}/{role_id}', 'ReportController@retailPLReport');
    Route::any('projectplexcel/{id}/{role_id}/{user}/{currency}/{from}/{to}', 'ReportController@projectPLReportExport');
    Route::any('retailplexcel/{id}/{role_id}/{user}/{currency}/{from}/{to}', 'ReportController@retailPLReportExport');















//role routes
Route::post('addrole', 'roleController@addRole');
Route::get('showrole', 'roleController@showRole');
Route::get('showrole/{id}', 'roleController@showSingleRole');
Route::post('updaterole/{id}', 'roleController@updateRole');
Route::get('deleterole/{id}', 'roleController@deleteRole');
Route::post('bulkdelete', 'roleController@deleteAll');

//country and product type list route
Route::get('countrylist','CountriesController@show');
Route::get('producttypelist','ProductTypeController@show');

//product routes
Route::post('addproduct','ProductController@add');
Route::post('addallproduct','ProductController@addAll');
Route::post('updateproduct/{id}','ProductController@updateProduct');
Route::get('showproduct','ProductController@showall');
Route::get('showproduct/{id}','ProductController@show');
Route::get('deleteproduct/{id}','ProductController@delete');


//data count routes
Route::get('countdata','countDataController@countData');
Route::get('countgraph','countDataController@countGraph');