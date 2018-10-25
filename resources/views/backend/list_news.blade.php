	@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-10 col-xs-offset-1">
	<div style="margin-bottom:5px;">
		<a href="{{ url('admin/news/add') }}" class="btn btn-primary">Add</a>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">News</div>
		<div class="panel-body">
			<table class="table table-hover table-bordered">
				<tr>
					<th style="width:50px;">STT</th>
					<th style="width:100px;">Ảnh</th>
					<th>Tiêu đề</th>
					<th style="width:150px;text-align: center;">Thuộc danh mục</th>
					<th style="width: 100px;text-align: center;">Hot news</th>
					<th style="width:100px;"></th>
				</tr>
				<?php $stt = 0; ?>
				@foreach($arr as $rows)
				<?php $stt++; ?>
				<tr>
					<td style="text-align:center;">{{ $stt }}</td>
					<td style="text-align:center;">
					@if(file_exists('upload/news/'.$rows->c_img))
					<img src="{{ asset('upload/news/'.$rows->c_img) }}" style="width: 100px;">
					@endif
					</td>
					<td>{{ $rows->c_name }}</td>
					<td style="text-align:center;">
						<?php 
							//lấy 1 bản ghi
						
							$category = DB::table("tbl_category_news")->where("pk_category_news_id","=",$rows->fk_category_news_id)->first();
							echo isset($category->c_name)?$category->c_name:"";
						
						 ?>
					</td>
					<td style="text-align: center;">
					@if($rows->c_hotnews==1)
					<span class="glyphicon glyphicon-check"></span>
					@endif
					</td>
					<td style="text-align:center;">
						<a href="{{ url('admin/news/edit/'.$rows->pk_news_id) }}">Edit</a>&nbsp;
						<?php $page = Request::get("page")>0?Request::get("page"):1; ?>
						<a href="{{ url('admin/news/delete/'.$rows->pk_news_id).'?page='.$page }}" onclick="return window.confirm('Are you sure?');">Delete</a>
					</td>
				</tr>
				@endforeach
			</table>
			<style type="text/css">
				.pagination{padding:0px; margin:0px;}			
			</style>
			{{ $arr->links() }}
		</div>
	</div>
</div>
@endsection