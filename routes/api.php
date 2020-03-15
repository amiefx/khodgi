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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/attribute-sets', 'Api\AttributeSetsController');

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::resource('/categories', 'Api\CategoriesController');

Route::get('/attribs', 'Api\AttributeSetsController@attribs');
Route::get('/subattribs/{attribute_set}', 'Api\AttributeSetsController@subattribs');

Route::resource('/home-slides', 'Api\HomeSlideController');
//Route::post('/home-slides/change-photoL', 'HomeSlideController@changePhotoL');
//Route::post('/home-slides/change-photoS', 'HomeSlideController@changePhotoS');

Route::resource('/home-sections', 'Api\HomeSectionController');

Route::group(['middleware' => ['auth:api'], 'namespace'=>'Api'], function () {
    Route::resource('/roles', 'RolesController');
    Route::resource('/users', 'UserController');
    Route::get('/verify', 'AuthController@verify');
    Route::post('roles/delete', 'RolesController@deleteAll');
    Route::post('users/delete', 'UserController@deleteAll');
    Route::post('email/verify', 'UserController@verifyEmail');
    Route::post('change-role', 'UserController@changeRole');
    Route::post('change-photo', 'UserController@changePhoto');
    Route::get('my-account', 'UserController@myAccount');
    Route::put('user/update-profile/{id}', 'UserController@updateProfile');

    // Route::resource('/home-slides', 'HomeSlideController');
     Route::post('/home-slides/change-photoL', 'HomeSlideController@changePhotoL');
     Route::post('/home-slides/change-photoS', 'HomeSlideController@changePhotoS');

     Route::post('/home-sections/change-photo', 'HomeSectionController@changePhoto');

   //  Route::resource('/attribute-sets', 'AttributeSetsController');
     Route::resource('/attributes', 'AttributesController');

     Route::resource('/products', 'ProductsController');
});

Route::post('/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Api\ResetPasswordController@reset');

Route::get('/email/resend', 'Api\VerificationController@resend')->name('verification.resend');
Route::get('/email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify');

