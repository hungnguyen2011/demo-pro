@extends('admin.index')
@section('title','Quản lí môn học')
@section('content')
<div>
    <h2>Danh sách môn học</h2>  
    <button class="btn btn-success"><a href="{{route('admin.subject.add-subject')}}">Thêm môn học</a></button>
    @if(Session::has('message'))
            <div class="alert alert-success" style="margin-top: 15px">{{Session::get('message')}}</div>
    @endif
    @if(Session::has('message-error'))
            <div class="alert alert-danger" style="margin-top: 15px">{{Session::get('message-error')}}</div>
    @endif       
    <table class="table" style="margin-top: 15px">
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="25%">Subject name</th>
                <th width="25%">Image</th>
                <th width="25%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
            <tr>
                <td>{{$subject->id}}</td>
                <td>{{$subject->subject_name}}</td>
                <td><img src="{{asset('storage'.$subject->image)}}" alt="" width="100px" height="100px"></td>
                <td>
                    <button class="btn btn-info"><a href="{{Route('admin.subject.edit-subject',$subject->id)}}">Sửa</a></button>
                    <button class="btn btn-danger"><a href="{{Route('admin.subject.delete-subject',$subject->id)}}" onclick="return confirm('Xóa môn học sẽ xóa tất cả bài thi liên quan đến môn {{$subject->subject_name}}')">Xóa</a></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection