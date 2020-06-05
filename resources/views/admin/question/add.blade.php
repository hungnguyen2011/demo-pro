@extends('admin.index')
@section('title',' Thêm Câu hỏi')
@section('content')
<style>
    .form-inline .form-control {
        width: 98%;
        margin-top: 15px;
    }
    .error {
        color: red;
        font-size: 12px;
    }
</style>
<div>
    <h2> Thêm câu hỏi</h2>
    <form id="question-form-data" action="{{route('admin.exam.add-question',$id)}}" method="post">
    @csrf
        <div style="border: 1px dotted;padding: 10px 10px;margin-top: 10px">
            <div>
            <label for="" style="font-size: 16px">Câu hỏi:</label>
            <br>
            <textarea name="question_content" cols="100%" rows="5" class="form-control"></textarea>
            </div>
            <label for="" style="font-size: 16px;padding-top: 20px">Option:</label>
            <div class="form-inline">
                <input type="radio" name="Iscorrect" value="0">
                <input type="text" name="option[]" value="" class="form-control">
                <br>
            </div>
            <div class="form-inline">
                <input type="radio" name="Iscorrect" value="1">
                <input type="text" name="option[]" value="" class="form-control">
                <br>
            </div>
            <div class="form-inline">
                <input type="radio" name="Iscorrect" value="2">
                <input type="text" name="option[]" value="" class="form-control">
                <br>
            </div>
            <div class="form-inline">
                <input type="radio" name="Iscorrect" value="3">
                <input type="text" name="option[]" value="" class="form-control">
                <br>
            </div>
        </div>
        <div style="text-align: right;padding-top: 20px">
            <a href="" class="btn btn-lg btn-primary bg-secondary">Hủy</a>
            <button class="btn btn-lg btn-primary" type="submit" >Thêm</button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $("#question-form-data").validate({
        ignore: [],
            onkeyup: function(ele) {
                $(ele).valid();
        },
        rules: {
            "question_content": {
                required: true,
            },
        },
    });
</script>
@endsection