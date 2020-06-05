@extends('web.home')
@section('title','login-user')
@section('content')
@if(Auth::check() && Auth::user()->type == 2)
@else
<div class="col-sm-7 des">
	<h3 style="text-align: center;font-size: 30px;font-weight: bold;color: #000082">Đăng nhập</h3>
	<hr>
	<div class="row">
	<div class="col-sm-10" style="margin-left: 30px">
	<form action="{{ route('user.login') }}" method="post">
		@csrf
		@if(Session::has('message'))
			<div class="alert alert-danger">{{Session::get('message')}}</div>
		@endif
		<div class="form-group">
			<label for="email">Tài khoản</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter user-name">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Mật khẩu</label>
			<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
		</div>
		<button type="submit" class="btn btn-info" style="width: 100%">Đăng nhập</button>
	</form>
	</div>
	<div class="col-sm-2"></div>
	</div>
	<hr>
</div>
@endif
@endsection