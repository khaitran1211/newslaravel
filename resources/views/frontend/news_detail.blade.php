@extends("frontend.layout")
@section("do-du-lieu")
<?php 
    use App\php27class\remove_unicode;
    $unicode = new remove_unicode();
 ?>
<?php 
	// Lấy một bản ghi ứng với id truyền vào
	$news = DB::table("tbl_news") -> where("pk_news_id","=",$id)->first();
 ?>
 <article>
                    	<div class="title-box">
                            <h1>{{ $news->c_name }}</h1>
                        </div>
                        <div class="post-thumb">
                        	<img src="{{ asset('upload/news/'.$news->c_img) }}" alt="">
                        </div>
                        <div class="post-content" style="margin-top: 10px;">
                            {!! $news->c_description !!}
                            {!! $news->c_content !!}
                            <div class="marked-title first">
                                <h3>Tin tức khác</h3>
                            </div>
            <?php 
            $news2 = DB::table("tbl_news")->orderBy("pk_news_id","desc")->offset(0)->limit(4)->get();

             ?>
             
                            <div class="row-fluid">
                               <!-- other news -->
                               @foreach($news2 as $rows)
                                <div class="span4">
                                    <article class="small single">
                                        <div class="post-thumb">
                                            <a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}"><img src="{{ asset('upload/news/'.$rows->c_img) }}" alt=""></a>
                                        </div>
                                        <div class="cat-post-desc">
                                            <h3><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></h3>
                                        </div>
                                    </article>    
                                </div>
                                @endforeach
                                <!-- end other news -->
                            </div>
                            
                            
                        </div>
                    </article>
@endsection