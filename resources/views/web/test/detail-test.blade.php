@extends('web.index')
@section('title','Thi online')
@section('content')
<style>
.subjectBtn {
    border: 1px solid;
    text-decoration: none!important;
    text-transform: uppercase;
    padding: 6px 11px;
    border-radius: 5px;
    font-weight: bold;
    margin-left: 5px;
    margin-right: 5px;
    font-size: 14px;
}
.activeSubject {
    background: #3ea9f5;
    color: white!important;
    border: none;
}
.list-subject {
    text-align: center;
}
.titleExam {
    font-size: 20px;
    color: rgb( 14, 115, 187 );
    line-height: 1.111;
    font-weight: bold;
    margin-top: 0px;
    margin-bottom: 5px;
}
.statusExam {
    font-size: 12px;
}
.buttonExamPanel {
    text-align: right;
}
.buttonExamPanel .btn {
    margin-right: 15px;
}
.buttonExamPanel .btn a {
    color: white;
    text-decoration: none;
}
.exam {
    margin-top:10px;
    padding-bottom: 15px;
    border-bottom: 2px dotted;
}
</style>
<div style="background-color:#f3f8fc ">
    <hr>
    <a class="path-item" href="/luyen-thi" style="padding-left: 80px">Trang chủ</a>
    <span class="glyphicon glyphicon-triangle-right" style="font-size: 12px"></span>
    <a class="path-item active" href="/luyen-thi/luyen-thi-vao-lop-10">Luyện thi-{{$subject_name}}</a>
    <hr>
</div>
<div class="container-fluid">
    <div class="list-subject">
        @foreach($subject as $sub)
        <a href="{{ route('user.detail-test', $sub->id) }}" class="subjectBtn activeSubject">{{$sub->subject_name}}</a>
        @endforeach
    </div>
    <div class="row">
        <h1 style="text-align: center;">Luyện thi THPT Quốc gia môn {{$subject_name}}</h1>
        <br>
    <div class="col-sm-1"></div>
    <div class="col-sm-8">
        @foreach($exams as $exam)
        <div class="exam">
            <div class="headExam">
                <h3 class="titleExam">Đề luyện thi THPT Quốc gia 2020 môn {{$subject_name}} - {{$exam->exam_name}}</h3>
                <span class="statusExam">Trạng thái :<i>@if(count($exam->user_exam)>0) Đã làm @else Chưa làm @endif</i></span>
            </div>
            <div>
                <p>{{$exam->description}}</p>
                <b>Thời gian làm đề: {{$exam->duration}} phút</b>
                <p><b>Tổng số câu: {{$exam->question_count}}</b></p>
            </div>
            <div class="buttonExamPanel">
                <button class="btn btn-primary"><a href="{{ route('user.start-test',$exam->id) }}">Vào thi</a></button>
                <button class="btn btn-success">In Đề - Export PDF</button>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-sm-3"></div>
    </div>
</div>
@endsection