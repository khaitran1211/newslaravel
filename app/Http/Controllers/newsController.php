<?php 
	namespace App\Http\Controllers;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	// Trong controller, muốn sử dụng đối tượng nào thì cần phải khai báo đối tượng đó bằng từ khóa use
	use DB;
	// Đối tượng DB thao tác với csdl
	//use Hash;
	class newsController extends Controller{
		// list
		public function show(){
			// hiển thị các bản ghi có phân trang
			$data["arr"] = DB::table("tbl_news")->orderBy("pk_news_id","desc")->select("pk_news_id","c_name","c_img","fk_category_news_id","c_hotnews")->paginate(10);
			return view("backend.list_news",$data);
		}
		// edit
		public function edit(Request $request,$id){
			// Lấy một bản ghi
			$data["arr"] = DB::table("tbl_news")->where("pk_news_id","=",$id)->first();
			return view("backend.add_edit_news",$data);
		}
		public function do_edit(Request $request,$id){
			$c_name = $request->get("c_name");
			$c_description = $request->get("c_description");
			$c_content = $request->get("c_content");
			$fk_category_news_id = $request->get("fk_category_news_id");
			$c_hotnews = ($request->get("c_hotnews")!="")?1:0;
			DB::table("tbl_news")->where("pk_news_id","=",$id)->update(array("c_name"=>$c_name,"c_description"=>$c_description,"c_content"=>$c_content,"fk_category_news_id"=>$fk_category_news_id,"c_hotnews"=>$c_hotnews));
			// ----------
			// Upload ảnh
			// Kiểm tra xem user có chọn hay không
			if($request->hasFile("c_img"));
			{
				// ------------
				// Xóa ảnh cũ trước khi thêm ảnh mới
				$old_img = DB::table("tbl_news")->where("pk_news_id","=",$id)->first();
				// kiểm tra xem ảnh này có tồn tại hay không
				if(file_exists("upload/news/".$old_img->c_img))
					unlink("upload/news/".$old_img->c_img);
				// -------------
				// Lấy tên file
				$img_name = time().$request->file("c_img")->getClientOriginalName();
				// thực hiện upload file, sử dụng hàm move("đường dẫn thư mục cần upload vào", tenanh)
				$request->file("c_img")->move("upload/news",$img_name);
				// Update c_img của bản ghi tương ứng với id truyền vào
				DB::table("tbl_news")->where("pk_news_id","=",$id)->update(array("c_img"=>$img_name));
			}
			// -----------------
			// quay trở lại url: admin/news
			return redirect("admin/news");

		}
		// Add
    	public function add(Request $request){
    		return view("backend.add_edit_news");
   		}
   		public function do_add(Request $request){
   			$c_name = $request->get("c_name");
			$c_description = $request->get("c_description");
			$c_content = $request->get("c_content");
			$fk_category_news_id = $request->get("fk_category_news_id");
			$c_hotnews = ($request->get("c_hotnews")!="")?1:0;
			
			$img_name = "";
			if($request->hasFile("c_img"));
			{
				// Lấy tên file
				$img_name = time().$request->file("c_img")->getClientOriginalName();
				// thực hiện upload file, sử dụng hàm move("đường dẫn thư mục cần upload vào", tenanh)
				$request->file("c_img")->move("upload/news",$img_name);
				
				
			}
			DB::table("tbl_news")->insert(array("c_name"=>$c_name,"c_description"=>$c_description,"c_content"=>$c_content,"fk_category_news_id"=>$fk_category_news_id,"c_hotnews"=>$c_hotnews,"c_img"=>$img_name));
			return redirect("admin/news");

   		}
   		public function delete(Request $request,$id){
   			// xóa ảnh ứng với id truyền vào
   			// ------------
				// Xóa ảnh cũ trước khi thêm ảnh mới
				$old_img = DB::table("tbl_news")->where("pk_news_id","=",$id)->first();
				// kiểm tra xem ảnh này có tồn tại hay không
				if(file_exists("upload/news/".$old_img->c_img))
					unlink("upload/news/".$old_img->c_img);
				// -------------
   			DB::table("tbl_news")->where("pk_news_id","=",$id)->delete();
   			return redirect("admin/news");
   		}
	}
 ?>