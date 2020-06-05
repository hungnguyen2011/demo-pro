@extends('web.home')
@section('title','sign-up-user')
@section('content')

<div class="col-sm-7 des">
	<h3 style="text-align: center;font-size: 30px;font-weight: bold;color: #000082">Đăng kí</h3>
	<hr>
	<div class="row">
	<div class="col-sm-10" style="margin-left: 30px">
	<form action="{{ route('user.sign-up') }}" method="post">
		@csrf
		@if(Session::has('message'))
			<div class="alert alert-success">{{Session::get('message')}}</div>
		@endif
		<div class="form-group">
			<label for="name">Họ và tên</label>
			<input type="text" class="form-control" id="name" placeholder="Nhập họ và tên của bạn" name="full_name">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email" name="email">
			<small class="form-text text-muted">Mật khẩu được gửi vào email đã đăng kí.</small>
		</div>
		<button type="submit" class="btn btn-info" style="width: 100%">Đăng kí</button>
	</form>
	</div>
	<div class="col-sm-2"></div>
	</div>
	<hr>
</div>
@endsection