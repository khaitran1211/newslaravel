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


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// // generate password
// Route::get("password",function(){
// 	echo Hash::make("123");
// });
// -------------------------
// Thực hiện phần admin, điều phối qua tag chung tên là admin -> thực hiện Route::group
//
Route::group(array("prefix"=>"admin","middleware"=>"auth"),function(){
	// User
	// ------------
	// List
	Route::get("user","userController@show");
	// Edit
	Route::get("user/edit/{id}","userController@edit");
	// when form submit
	Route::post("user/edit/{id}","userController@do_edit");
	// Add
	Route::get("user/add","userController@add");
	// when form submit
	Route::post("user/add","userController@do_add");
	// delete
	Route::get("user/delete/{id}","userController@delete");

	// ------------
	// news
	// ------------
	// List
	Route::get("news","newsController@show");
	// Edit
	Route::get("news/edit/{id}","newsController@edit");
	// when form submit
	Route::post("news/edit/{id}","newsController@do_edit");
	// Add
	Route::get("news/add","newsController@add");
	// when form submit
	Route::post("news/add","newsController@do_add");
	// delete
	Route::get("news/delete/{id}","newsController@delete");

	// ------------
	// Category news
	// ------------
	// List
	Route::get("category","category_newsController@show");
	// Edit
	Route::get("category/edit/{id}","category_newsController@edit");
	// when form submit
	Route::post("category/edit/{id}","category_newsController@do_edit");
	// Add
	Route::get("category/add","category_newsController@add");
	// when form submit
	Route::post("category/add","category_newsController@do_add");
	// delete
	Route::get("category/delete/{id}","category_newsController@delete");

	// ------------

});
// ----------------
Route::get("logout",function(){
	// Thực hiện đăng xuất
	Auth::logout();
	// Di chuyển đến url public/admin -> sử dụng hàm return redirect(url)
	return redirect(url('admin'));
});
// url admin
Route::get("admin",function(){
	// Di chuyển đến url: admin/user
	return redirect(url('admin/user'));
});
// ----------------

// -----------------
// Frontend
// Trang chủ (trang đầu tiên)
Route::get("",function(){
	return view("frontend.home");
});
// Danh mục tin tức
Route::get("news/category/{id}/{name}",function($id,$name){
	$data["id"] = $id;
	return view("frontend.news_category",$data);
});
Route::get("news/detail/{id}/{name}",function($id,$name){
	$data["id"] = $id;
	return view("frontend.news_detail",$data);
});
Route::get("search/{key}",function($key){
	$data["key"]=$key;
	return view("frontend.search",$data);
});