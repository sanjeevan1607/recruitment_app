<?php
Route::group(
    [
        'middleware' => ['api'],
        //'prefix' => 'auth'
    ], function () {
    /**
     * User Route
     */
    Route::post('user/me', 'AuthController@user');
    Route::post('user/login', 'AuthController@login');
    Route::post('user/logout', 'AuthController@logout');
    Route::post('user/refresh', 'AuthController@refresh');
    Route::post('user/register', 'AuthController@register');
    /**
     * User Type Rousts
     */
    Route::post('users', 'UserController@index');
    Route::post('users/{uID}', 'UserController@show');
    Route::post('users/{uID}/edit', 'UserController@edit');

});
