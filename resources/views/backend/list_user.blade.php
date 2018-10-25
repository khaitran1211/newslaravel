@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">
	<div style="margin-bottom:5px;">
		<a href="{{ url('admin/user/add/') }}" class="btn btn-primary">Add user</a>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">List User</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th style="width:100px;"></th>
				</tr>
				@foreach($arr as $rows)
				<tr>
					<td>{{ $rows->name }}</td>
					<td>{{ $rows->email }}</td>
					<td style="text-align:center;">
						<a href="{{url('admin/user/edit/'.$rows->id)}}" >Edit</a>&nbsp;
						<?php 
							$page = Request::get('page')>0?Request::get('page'):1;
						 ?>
						<a href="{{ url('admin/user/delete/'.$rows->id).'?page='.$page }}" onclick="return window.confirm('Are you sure?');">Delete</a>
					</td>
				</tr>
				@endforeach
			</table>
			<style type="text/css">
				.pagination{padding:0px; margin:0px;}
			</style>
			<!-- Phân trang bằng hàm render() hoặc links() -->
			{{ $arr->render() }}
		</div>
	</div>
</div>
@endsection