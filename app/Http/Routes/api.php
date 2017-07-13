<?php

//Route::post('api/authenticate', 'Auth\AuthenticateController@authenticate');
Route::group(['prefix' => 'api-auth'], function(){
    Route::post('authenticate', 'Auth\AuthenticateController@authenticate');
});

app('api.router')->group(['version'=>'v1', 'namespace'=>'App\\Http\\Controllers\\Api'], function($api){
	$api->post('register-attendance', 'AttendanceController@registerAttendance');
	$api->post('check-ci-exists', 'AttendanceController@checkCiExists');
	$api->post('upload-image', 'AttendanceController@uploadImage');
	$api->post('register-checkpoint', 'SupervisorController@registerCheckpoint');
});