<?php 
    use App\php27class\remove_unicode;
    $unicode = new remove_unicode();
 ?>
<div class="widget">
                            <div class="marked-title">
                                <h3>Danh mục tin tức</h3>
                            </div>
                            <ul class="tags">
                <?php 
                    $category = DB::table("tbl_category_news")->orderBy("pk_category_news_id","desc")->get();
                    // $category = DB::select("select * from tbl_category_news order by pk_category_news_id desc");
                 ?>
                 @foreach($category as $rows)
                                <li><a class="photo" href="{{ url('news/category/'.$rows->pk_category_news_id.'/'.$unicode->write_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></li>
                @endforeach             
                            </ul>
                            <div class="clear"></div>
                        </div>