@extends('admin.index')
@section('title','Quản lí bài thi')
@section('content')
<style>
.detailBtn {
    border-width: 1px;
    border-style: solid;
    border-radius: 5px;
    margin-top: 10px;
    font-size: 16px;
    color: rgb( 62, 169, 245 );
    border-color: rgb( 62, 169, 245 );
    padding: 5px 20px 5px 20px;
    background: white;
}
.detailBtn:hover {
    background-color: #3ea9f5;
}
.detailBtn a:hover {
    color:white;
    text-decoration: none;
}
.subject {
    font-size: 20px;
    font-weight: bold;
}
.block-subject {
    border: 1px solid gray; 
    text-align: center;
    height: 100%;
    border-radius: 8px;
    padding: 20px 0px;
    margin-bottom: 30px;
}
.block-subject:hover {
    border: 1px solid #3ea9f5;
}
.block-subject a {
    text-decoration: none;
}
</style>
<div>
    <h2>Chủ đề bài thi</h2>
    <div class="col-sm-1"></div>
    <div class="col-sm-10" style="margin-top: 40px">
        @foreach($subject as $sub)
        <div class="col-sm-3">
            <div class="block-subject">
                <a href="{{route('admin.exam.list-exam',$sub->id)}}">
                <img alt="{{$sub->subject_name}}" src="{{asset('storage'.$sub->image)}}" height="150px">
                <h2 class="subject">{{$sub->subject_name}}</h2>
                </a>
            </div>
        </div>
        @endforeach   
    </div>
    <div class="col-sm-1"></div>
</div>
@endsection