@extends('admin.index')
@section('title','...')
@section('content')
</style>
<div>
    <h2>Danh sách bài thi - {{$subject}}</h2>
    <button class="btn btn-success"><a href="{{route('admin.exam.add-exam',$id)}}">Thêm bài thi</a></button>
    @if(Session::has('message'))
        <div class="alert alert-success" style="margin-top: 15px">{{Session::get('message')}}</div>
    @endif
        <table class="table" style="margin-top: 15px">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="25%">Exam name</th>
                <th width="15%">Question count</th>
                <th width="10%">Duration</th>
                <th width="25%">Description</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $exam)
            <tr>
                <td>{{$exam->id}}</td>
                <td>{{$exam->exam_name}}</td>
                <td>{{$exam->question_count}}</td>
                <td>{{$exam->duration}}</td>
                <td>{{$exam->description}}</td>
                <td>
                    <button class="btn btn-info"><a href="{{route('admin.exam.edit-exam',['id'=>$id,'id1'=>$exam->id])}}">Sửa</a></button>
                    <button class="btn btn-danger"><a href="{{route('admin.exam.delete-exam',$exam->id)}}" onclick="return confirm('Xóa bài thi sẽ xóa cả câu hỏi và đáp án của bài thi đó')">Xóa</a></button>
                    <button class="btn btn-success"><a href="{{route('admin.exam.list-question',$exam->id)}}">Thêm câu hỏi</a></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection