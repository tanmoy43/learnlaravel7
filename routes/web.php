<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/fuckYou', function () {
    return view('about');
})->name('about');

Route::get('/Service', function () {
    return view('service');
});

Route::get('/Contact', 'ContactContrller@contact');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Category
Route::get('Category/All', 'CategoryController@Allcat')->name('All.category');
Route::post('Category/Add', 'CategoryController@Addcat')->name('store.category');
Route::get('Category/Edit/{id}','CategoryController@Edit');
Route::post('Store/Category/{id}', 'CategoryController@Update');
Route::get('Softdelete/Category/delete/{id}', 'CategoryController@SoftDelete');
Route::get('Category/Restore/{id}','CategoryController@Restore');
Route::get('Category/Parmanent_delete/{id}', 'CategoryController@ParmanentDelete');

// Brand
Route::get('Brand/All', 'BrandController@AllBrand')->name('All.brand');
Route::post('Brand/Add', 'BrandController@Addbrand')->name('store.brand');
Route::get('Brand/Edit/{id}','BrandController@Edit');
Route::post('Store/Brand/{id}', 'BrandController@Update');
Route::get('Brand/delete/{id}', 'BrandController@Delete');

// Multi Image
Route::get('Multiple/Image', 'BrandController@index')->name('All.Multipleimage');
Route::post('Multiple/Image/Store', 'BrandController@StoreImg')->name('store.image');

// User Profile
Route::get('User/Profile', 'BrandController@Profile')->name('profile.user');