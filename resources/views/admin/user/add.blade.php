@extends('admin.index')
@section('title','')
@section('content')
<style>
td.weight {
	font-weight: bold;
}
tr td {
	border: none !important;
}
.table {
	border: 1px solid #dacfcf;
}
.error {
	color: red;
	font-size: 12px;
}
.type {
	position: relative;
}
.type label.error {
	position: absolute;
	top: 28px;
	left: 10px;
}
</style>
<h2>Thêm User</h2>
<div class="row" style="margin-top: 50px"> 
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<form  id="user-form-data" action="{{route('admin.add-user')}}" method="post" >
			@csrf
			<table class="table">
				<tbody>
					<tr>
						<td class="weight">Họ và tên<span class="text-danger">(*)</span></td>
						<td> <input type="text" class="form-control" name="full_name" value="">
						</td>
					</tr>
					<tr>
						<td class="weight">Email<span class="text-danger">(*)</span></td>
						<td>
							<input type="email" class="form-control" name="email" value="">
						</td>
					</tr>
					<tr>
						<td class="weight">Quyền<span class="text-danger">(*)</span></td>
						<td class="type">
							<input type="radio" name="type" value="1" id="1"><label for="1">Admin</label>
							<input type="radio" name="type" value="2" id="2"><label for="2">User</label>
						</td>
					</tr>
					<tr>
						<td></td>
						<td class="">
							<a href="{{route('admin.list')}}" class="btn btn-primary bg-secondary">Hủy</a>
							<button class="btn btn-primary" type="submit" >Thêm</button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<div class="col-sm-1"></div>
</div>
@endsection

@section('script')
<script>
	$().ready(function() {
		$.validator.addMethod("verifyEmail",function(value, element) {
			let result = false;
			$.ajaxSetup({
  				headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  				}
			});
			$.ajax({
				type:"POST",
				async: false,
				url: "{{route('admin.user-mail')}}",
				data: {"email": value},
				success: function(data) {
					result = (data == true) ? false : true;
				}
			});
			return result;
		},'This email already exists');
		$("#user-form-data").validate({
			ignore: [],
		    	onkeyup: function(ele) {
		      	$(ele).valid();
		    },
			rules: {
				"full_name": {
					required: true,
					maxlength: 32,
				},
				"email": {
					required: true,
					verifyEmail: true,
				},
				"type" : {
					required: true,
				},
			}
		});
	});
</script>
@endsection