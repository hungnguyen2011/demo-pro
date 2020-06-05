@extends('admin.index')
@section('title',' Sửa Câu hỏi')
@section('content')
<div>
    <h2> Sửa câu hỏi</h2>

    <div style="border: 1px dotted;padding: 10px 10px;margin-top: 10px">
        <form action="{{route('admin.exam.edit-question',$question->id)}}" method="post">
            @csrf
            <label for="" style="font-size: 16px">Câu hỏi:</label>
            <br>
            <textarea name="question_content" cols="100%" rows="5" class="form-control">{{$question->question_content}}</textarea>
            <label for="" style="font-size: 16px">Option:</label>
            @foreach($answers as $ans)
            <input type="text" name="{{$ans->id}}" value="{{$ans->option}}" width="100%" class="form-control">
            <br>
            @endforeach
            <div style="text-align: right;padding-top: 20px">
                <a href="" class="btn btn-lg btn-primary bg-secondary">Hủy</a>
                <button class="btn btn-lg btn-primary" type="submit" >Sửa</button>
            </div>
        </form>
    </div>
</div>
@endsection