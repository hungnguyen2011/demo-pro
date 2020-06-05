@extends('admin.index')
@section('title','Câu hỏi')
@section('content')
<div>
    <h2>{{$sub}} - {{$exam}} - Danh sách câu hỏi</h2>
    <button class="btn btn-success"><a href="{{route('admin.exam.add-question',$id)}}">Thêm câu hỏi</a></button>
    <h3 style="text-align: right;margin-right: 3%">Số câu hỏi : {{count($questions)}}</h3>
    @if(Session::has('message'))
        <div class="alert alert-success" style="margin-top: 15px">{{Session::get('message')}}</div>
    @endif
    @if(Session::has('message-err'))
        <div class="alert alert-danger" style="margin-top: 15px">{{Session::get('message-err')}}</div>
    @endif
    @foreach($questions as $question)
    <div style="border: 1px dotted;padding: 10px 10px;position: relative;margin-top: 10px">
        <label for="" style="font-size: 16px">Câu hỏi:</label> 
        {{$question->question_content}}
        <div class="answer">
            <table>
                @foreach($question->answer as $ans)
                    <tr id="input_{{$ans->id}}" @if($ans->Iscorrect == 1) style="color: blue" @endif>
                        <td>Option  : </td>
                        <td>{{$ans->option}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div style="position: absolute;right:5%;top:15%">
            <button class="btn btn-info"><a href="{{route('admin.exam.edit-question',$question->id)}}">Sửa</a></button>
            <button class="btn btn-danger"><a href="{{route('admin.exam.delete-question',$question->id)}}" onclick="return confirm('Xóa câu hỏi và đáp án')">Xóa</a></button>
        </div>
    </div>
    <br>
    @endforeach
</div>
@endsection