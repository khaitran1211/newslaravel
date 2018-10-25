@extends("frontend.layout")
@section("do-du-lieu")
<?php 
    use App\php27class\remove_unicode;
    $unicode = new remove_unicode();
 ?>
                    <div class="marked-title">
<?php 
    // Lấy một bản ghi
$category = DB::table("tbl_category_news")->where("pk_category_news_id","=",$id)->first();
// Lấy các bản ghi trong tbl_news tương ứng với khóa ngoại truyền từ url
$news = DB::table("tbl_news")->where("fk_category_news_id","=",$id)->orderBy("pk_news_id","desc")->paginate(10);
//$news = DB::table("tbl_news")->where("fk_category_news_id","=",Request::get("id"))->orderBy("pk_news_id","desc")->paginate(10);

 ?>
                        <h3>{{ $category->c_name }}</h3>
                    </div>
                    <div class="row">
                        <!-- list news -->
                        @foreach($news as $rows)
                        <article>
							<div class="cat-post-desc">
								<h3><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></h3>
								<p><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}"><img style="max-width: 500px;" src="{{ asset('upload/news/'.$rows->c_img) }}" alt=""></a>{!! $rows->c_description !!}</p>
							</div>
							<div class="clear"></div>
							<div class="line_category"></div>
						</article>                       
                        <!-- end list news -->
                        
                        
                        @endforeach
                                                                                
                                                
                    </div>
                    <div class="clear"></div>
                    {{ $news->render() }}
                    @endsection