<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'admin'], function(){
    Route::get('list-user/{type}/{action}/{status?}', 'CustomAdminController@getListUser');
    Route::post('download-user-excel', 'CustomAdminController@postDownloadUserExcel');
    Route::get('list-form/{user_id}', 'CustomAdminController@getListForm');
    Route::post('assign-form', 'CustomAdminController@postAssignForm');
    Route::get('my-forms', 'CustomAdminController@getRedirectUserForms');
    Route::get('project/{id}', 'CustomAdminController@getProject');
    Route::get('form-list', 'CustomAdminController@getFormList');
    Route::get('form-fields/{id}', 'CustomAdminController@getFormFields');
    Route::get('form/{action}/{id?}', 'CustomAdminController@getForm');
    Route::post('form', 'CustomAdminController@postForm');
    Route::get('form-field/{action}/{parent_id}/{id?}', 'CustomAdminController@getFormField');
    Route::post('form-field', 'CustomAdminController@postFormField');
    Route::get('export-forms', 'CustomAdminController@getExportForms');
    Route::get('import-forms', 'CustomAdminController@getImportForms');
});