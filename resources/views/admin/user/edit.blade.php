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
</style>
<h2>Sửa User</h2>
<div class="row" style="margin-top: 50px"> 
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<form  id="user-form-data" action="{{route('admin.edit-user',$user->id)}}" method="post" >
	    @csrf
		    <table class="table">
		      <tbody>
		        <tr>
		          <td class="weight">Họ và tên<span class="text-danger">(*)</span></td>
		          <td> <input type="text" class="form-control" name="full_name" value="{{$user->full_name}}">
		          </td>
		        </tr>
		        <tr>
		          <td class="weight">Email<span class="text-danger">(*)</span></td>
		          <td>
		            <input type="email" class="form-control" name="email" value="{{$user->email}}" disabled="">
		          </td>
		        </tr>
		        <tr>
		          <td class="weight">Quyền<span class="text-danger">(*)</span></td>
		          <td>
		          	@if($user->type == App\User::TYPE_ADMIN)
		            <input type="radio" name="type" value="1" id="1" checked=""><label for="1">Admin</label>
		            <input type="radio" name="type" value="2" id="2"><label for="2">User</label>
		            @else
		            <input type="radio" name="type" value="1" id="1" ><label for="1">Admin</label>
		            <input type="radio" name="type" value="2" id="2" checked=""><label for="2">User</label>
		            @endif
		          </td>
		        </tr>
		        <tr>
          			<td></td>
          			<td class="">
		            <a href="{{route('admin.list')}}" class="btn btn-primary bg-secondary">Hủy</a>
		            <button class="btn btn-primary" type="submit">Chỉnh sửa</button>
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
	$("#user-form-data").validate({
		rules: {
			"full_name": {
				required: true,
				maxlength: 32,
			},
			"type" : {
				required: true,
			},
		}
	});
});
</script>
@endsection