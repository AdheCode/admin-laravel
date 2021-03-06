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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin', 'AdminController@login');
Route::match(['get', 'post'], '/admin', 'AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){
	Route::get('/admin/dashboard', 'AdminController@dashboard');
	Route::get('/admin/settings', 'AdminController@settings');
	Route::get('/admin/check-pwd', 'AdminController@chkPassword');
	Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

	//Categories Routes (Admin)
	Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
	Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
	Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');
	Route::get('/admin/view-categories', 'CategoryController@viewCategories');

	//Product
	Route::match(['get', 'post'], '/admin/add-product', 'ProductsController@addProduct');
	Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductsController@editProduct');
	Route::get('/admin/view-products', 'ProductsController@viewProducts');
});


Route::get('/logout', 'AdminController@logout');

//#11 Make E-commerce website in Laravel 5.6 | #22 Admin Panel | Edit Products