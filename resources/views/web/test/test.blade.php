@extends('web.index')
@section('title','Thi online')
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
</style>
<div style="background-color:#f3f8fc ">
    <hr>
    <a class="path-item" href="/luyen-thi" style="padding-left: 80px">Trang chủ</a>
    <span class="glyphicon glyphicon-triangle-right" style="font-size: 12px"></span>
    <a class="path-item active" href="/luyen-thi/luyen-thi-vao-lop-10">Luyện thi</a>
    <hr>
</div>
<div>
    <h1 style="text-align: center;">Luyện Thi THPT Quốc Gia</h1>
    <br>
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        @foreach($subject as $sub)
        <div class="col-sm-3">
            <div class="block-subject">
                <img alt="{{$sub->subject_name}}" src="{{asset('storage'.$sub->image)}}" height="150px">
                <h2 class="subject">{{$sub->subject_name}}</h2>
                <button class="detailBtn"><a href="{{ route('user.detail-test', $sub->id) }}">Xem chi tiết</a></button>
            </div>
        </div>
        @endforeach   
    </div>
    <div class="col-sm-1"></div>
</div>
@endsection