@extends("frontend.layout")
@section("do-du-lieu")
<?php 
    use App\php27class\remove_unicode;
    $unicode = new remove_unicode();
 ?>
                    
<?php 
// Lấy các bản ghi trong tbl_news tương ứng với khóa ngoại truyền từ url
$news = DB::select("select * from tbl_news where c_name like '%$key%' or c_description like '%$key%' order by pk_news_id desc");
//$news = DB::table("tbl_news")->where("fk_category_news_id","=",Request::get("id"))->orderBy("pk_news_id","desc")->paginate(10);

 ?>

                    
                    <div class="row">
                        <!-- list news -->
                        @foreach($news as $rows)
                        <article>
							<div class="cat-post-desc">
								<h3><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></h3>
								<p><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}"><img src="{{ asset('upload/news/'.$rows->c_img) }}" alt=""></a>{!! $rows->c_description !!}</p>
							</div>
							<div class="clear"></div>
							<div class="line_category"></div>
						</article>                       
                        <!-- end list news -->
                        
                        
                        @endforeach
                                                                                
                                                
                    </div>
                    <div class="clear"></div>
                    @endsection