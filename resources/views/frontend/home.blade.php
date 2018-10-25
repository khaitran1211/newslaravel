@extends("frontend.layout")
@section("do-du-lieu")
<?php 
    use App\php27class\remove_unicode;
    $unicode = new remove_unicode();
 ?>
<?php 
		//Lấy toàn bộ danh mục
		$category = DB::table("tbl_category_news")->orderBy("pk_category_news_id","desc")->get();
		 //$category = DB::select("select * from tbl_category_news order by pk_category_news_id desc"); 
 ?>
 @foreach($category as $rows_category)
 <?php 
 	// Kiểm tra các danh mục nếu không có các tin tức thì không hiển thị
 	// Sử dụng hàm Count() để trả về số lượng bản ghi
 	$check = DB::table("tbl_news")->where("fk_category_news_id","=",$rows_category->pk_category_news_id)->Count();

  ?>
  @if($check > 0)
                    <!-- list category tin tuc -->
                    <div class="row-fluid">
                        <div class="marked-title">
                            <h3><a href="{{ url('news/category/'.$rows_category->pk_category_news_id.'/'.$unicode->write_unicode($rows_category->c_name)) }}" style="color:white">{{ $rows_category->c_name }}</a></h3>
                        </div>
                    </div>                    
                    <div class="row-fluid">
                        <div class="span2">

            <?php 
            	// lấy tin đầu tiên
            	$first_news = DB::table("tbl_news")->where("fk_category_news_id","=",$rows_category->pk_category_news_id)->orderBy("pk_news_id","desc")->first();
            	// $first_news = DB::select("select * from tbl_news where fk_category_news_id." order by pk_news_id desc limit 0,1);
             ?>
                           <!-- first news -->
                            <article>
                                <div class="post-thumb">
                                    <a href="{{ url('news/detail/'.$first_news->pk_news_id.'/'.$unicode->write_unicode($first_news->c_name)) }}"><img src="{{ asset('upload/news/'.$first_news->c_img) }}" alt="{{ $first_news->c_name }}"></a>
                                </div>
                                <div class="cat-post-desc">
                                    <h3><a href="{{ url('news/detail/'.$first_news->pk_news_id.'/'.$unicode->write_unicode($first_news->c_name)) }}">{{ $first_news->c_name }}</a></h3>
                                    <p>{!! $first_news->c_description !!}</p>
                                </div>
                            </article>
                            <!-- end first news -->
                        </div>
                        <div class="span2">
                <?php 
                // Lấy 3 bài tin tiếp theo sau bài tin đầu tiên
                $news = DB::table("tbl_news")->where("fk_category_news_id","=",$rows_category->pk_category_news_id)->offset(1)->limit(3)->get();


                 ?>
                 @foreach($news as $rows)
                           <!-- list news -->
                            <article class="twoboxes">
                                <div class="right-desc">
                                    <h3><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}"><img src="{{ asset('upload/news/'.$rows->c_img) }}" alt="{{ $rows->c_name }}"></a><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></h3>  
                                    <div class="clear"></div>    
                                </div>
                                <div class="clear"></div>
                            </article>
                            <!-- end list news -->
                      @endforeach      
                        </div>
                    </div>
                    <div class="clear"></div>
                    @endif
                    @endforeach
@endsection