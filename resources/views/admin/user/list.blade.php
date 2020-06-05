@extends('admin.index')
@section('title','Quản lí user')
@section('content')
<div>
    <h2>Danh sách User</h2>  
    <button class="btn btn-success"><a href="{{route('admin.add-user')}}">Thêm user</a></button>
    @if(Session::has('message'))
            <div class="alert alert-success" style="margin-top: 15px">{{Session::get('message')}}</div>
    @endif       
    <table class="table" style="margin-top: 15px">
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="25%">Full name</th>
                <th width="25%">Email</th>
                <th width="10%">Role</th>
                <th width="25%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->full_name}}</td>
                <td>{{$user->email}}</td>
                <td>@if($user->type == App\User::TYPE_ADMIN) Admin @else User @endif</td>
                <td>
                    <button class="btn btn-info"><a href="{{route('admin.edit-user',$user->id)}}">Sửa</a></button>
                    <button class="btn btn-danger"><a href="{{route('admin.delete-user',$user->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa Tài khoản {{$user->email}}')">Xóa</a></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection