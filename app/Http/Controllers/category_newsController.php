<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class category_newsController extends Controller
{
    public function show(Request $request){
    	$data["arr"] = DB::table("tbl_category_news")->orderBy("pk_category_news_id","asc")->paginate(4);
    	return view("backend.list_category_news",$data);
    }
    public function edit(Request $request,$id){
    	$data["arr"] = DB::table("tbl_category_news")->where("pk_category_news_id","=",$id)->first();
    	return view("backend.add_edit_category_news",$data);
    }
    public function do_edit(Request $request,$id){
    	$c_name = $request->get("c_name");
    	DB::table("tbl_category_news")->where("pk_category_news_id",'=',$id)->update(array("c_name"=>$c_name));
    	return redirect("admin/category");
    }
    public function add(Request $request){
    	return view("backend.add_edit_category_news");
    }
    public function do_add(Request $request){
    	$c_name = $request->get("c_name");
    	DB::table("tbl_category_news")->insert(array("c_name"=>$c_name));
    	return redirect("admin/category");
    }
    public function delete(Request $request,$id){
    	DB::table("tbl_category_news")->where("pk_category_news_id","=",$id)->delete();
    	return redirect("admin/category");

    }
}
