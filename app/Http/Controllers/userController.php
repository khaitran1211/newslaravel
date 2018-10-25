<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Trong controller, muốn sử dụng đối tượng nào thì cần phải khai báo đối tượng đó bằng từ khóa use
use DB;
// Đối tượng DB thao tác với csdl
use Hash;
class userController extends Controller
{
    
    // list user
    public function show(Request $request){
    	// Lấy tất cả các bản ghi trong table users, phân 4 bản ghi trên 1 trang theo cấu trúc:
    	// DB::table(tenbang)->paginate(4)
    	// paginate(so-ban-ghi-tren-mot-trang) là hàm phân timezone_transitions_get()
    	$data["arr"] = DB::table("users")->orderBy("id","asc")->paginate(4);
    	return view("backend.list_user",$data);
    }
    // Edit user
    public function edit(Request $request,$id){
    	// Lấy một bản ghi tương ứng với id truyền vào. sử dụng hàm first()
    	$data["arr"] = DB::table("users")->where("id","=",$id)->first();
    	return view("backend.add_edit_user",$data);
    }
    // do edit user
    public function do_edit(Request $request,$id){
    	// Lấy form control có name=name
    	$name = $request->get("name");
    	// Lấy form control có name=password
    	$password = $request->get("password");
    	// Update bản ghi tương ứng với id truyền vào
    	DB::table("users")->where("id","=",$id)->update(array("name"=>$name));
    	// Nếu user nhập password thì tiến hành đổi password
    	if($password !=""){
    		// Mã hóa password theo kiểu của laravel
    		$password = Hash::make($password);
    		// Update lại password ứng với id truyền vào
    		DB::table("users")->where("id","=",$id)->update(array("password"=>$password));
    	}
    	// Di chuyển đến url admin/user
    	return redirect(url("admin/user"));
    }
    // Add
    public function add(Request $request){
    	return view("backend.add_edit_user");
    }
    // Do_add
    public function do_add(Request $request){
    	// Lấy form control có name=name
    	$name = $request->get("name");
    	// Lấy form control có name=name
    	$email = $request->get("email");
    	// Lấy form control có name=password
    	$password = $request->get("password");
    	// Kiểm tra xem email đã tồn tại chưa, nếu chưa tồn tại thì mới insert bản ghi vào. Hàm count() sẽ đếm số lượng bản ghi
    	$check = DB::table("users")->where("email","=",$email)->Count();
    	if($check == 0){
    		$password = Hash::make($password);
    		// Insert bản ghi
    		DB::table("users")->insert(array("name"=>$name,"email"=>$email,"password"=>$password));
    	}
    	// Di chuyển đến url admin/user
    	return redirect(url("admin/user"));
    }
    // delete
    public function delete(Request $request,$id){
    	// Xóa bản ghi tương ứng với id truyền vào
    	DB::table("users")->where("id","=",$id)->delete();
    	$page = $request->get("page");
    	// Di chuyển đến url admin/user
    	return redirect(url("admin/user?page=".$page));
    }
}
