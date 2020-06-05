@extends('web.index')
@section('title','Làm bài thi')
@section('content')
<style>
    .exam{
        box-shadow: 0px 3px 66px -24px rgba(0, 0, 0, 0.2);
        background: #fff;
        padding: 50px;
        border: 1px dotted;
        position: relative;
    }
    .right{
        position: sticky;
        top: 0px;
        background: #fff;
    }
    .left {
        width: 100%;
    }
    input[type='radio'] {
        border: 0px;
        width: 2em;
        height: 20px;
    }
    .completed {
        display: none;
    }
    .answer tr td {
        padding: 5px 5px;
    }
    .alert {
        border: 1px dotted blue;
        border-radius: 10px;
        text-align: center;
    }
    h1.timer {
        margin-left: 42%;
    }
    .jst-hours {
        float: left;
    }
    .jst-minutes {
        float:left;
    }
    .jst-seconds {
        float: left;
    }
    b {
        color: red;
    }

    h5{
        text-align: center;
    }
    h4.modal-title{
        background-color: dodgerblue;
        text-align: center;
        border-radius: 5px;
        font-size:28px;
        color: white;
        padding: 10px;
    }
    .modal-body h5{
        color: red;
    }
    .modal-body a{
        color:red;
        font-size: 20px;
        font-weight: 600;
    }
    .modal-body p{
        color:#2517de;
        margin:10px;
        font-weight: 550;
        font-size: 18px;
    }
</style>
<div style="background-color:#f3f8fc ">
    <hr>
    <a class="path-item" href="/luyen-thi" style="padding-left: 80px">Trang chủ</a>
    <span class="glyphicon glyphicon-triangle-right" style="font-size: 12px"></span>
    <a class="path-item active" href="/luyen-thi/luyen-thi-vao-lop-10">Luyện thi - {{$subject_name}}</a>
    <hr>
</div>
    <div class="container-fluid">

        <div id="content">  
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10 exam"> 
                    <br>
                    <form id="Demo" action="" method="">
                        @csrf
                        <input type="hidden" class="exam_id" value="{{$exam->id}}">
                        <br>
                        <div class="right">
                            <div class="alert">
                            <h4 style="color: red;font-weight: bold;text-transform:uppercase">{{$exam->exam_name}}</h4>
                            <div id="finish">
                            <h4>Thời gian làm bài</h4>
                            <h1 class='timer' data-minutes-left={{$exam->duration}}></h1>
                            <br>
                            <br>
                            <b class="completed">Đã làm được: <i></i>/{{$exam->question_count}}</b>
                            <br>
                                <button type="button" id="sub" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Hoàn thành bài</button>
                            </div>
                            <div id="alert2">
                                <button type="button" class="btn btn-primary btn-lg" id="show">Xem đáp án</button> 
                                
                                <a type="button" class="btn btn-primary btn-lg" href="{{route('user.start-test',$exam->id)}}">Làm lại bài </a> 
                            </div>
                            </div>
                        </div>
                        <div class="left">
                            @foreach($questions as $key => $question)
                            <label for="" style="font-size: 16px">Câu {{$key+1}}:</label> 
                            {{$question->question_content}}
                            <div style="border-bottom: 1px dotted" class="answer">
                                <table>
                                    @foreach($question->answer as $ans)
                                    <tr id="input_{{$ans->id}}">
                                        <td><input type="radio" name="{{$ans->question_id}}" value="{{$ans->id}}" width="100px"></td>
                                        <td>{{$ans->option}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <br>
                            @endforeach
                            
                        </div>
                        
                    </form>
                </div>
                <div class="col-sm-1"></div>
            </div>
            
        </div> <!-- #content -->
    </div> <!-- .container -->

    <div class="modal fade" id="myModal" role="dialog" >
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Kết quả bài thi của bạn</h4>
                </div>
                <div class="modal-body">
                    <h5></h5>
                    <a> Thí sinh : @if(Auth::check()) {{Auth::user()->full_name}} @endif </a>
                    <table>
                        <tr>
                            <td><p>Số câu hỏi :</p></td>
                            <td><p id="questions_count"></p></td>
                        </tr>
                        <tr>
                            <td><p>số câu đã làm :</p></td>
                            <td><p id="amount"></p></td>
                        </tr>
                        <tr>
                            <td><p><p>số câu còn lại :</p></td>
                            <td><p id="rest"></p></td>
                        </tr>
                        <tr>
                            <td><p>Số câu đúng :</p></td>
                            <td><p id="count"></p></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('script')
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/jquery.simple.timer.js"></script>
<script>
    let id = $('.exam_id').val();
    $(document).ready(function($){
        $('#alert2').hide();
        $('#sub').click(function(event) {
            $('#alert2').show(1000);
            $('#finish').hide(1000);
        });
        $('input').click(function(event) {
            $('.completed').show();
        });
        $('input:radio').click(function(event) {
            var checked=$('input:radio:checked').length ;
            $('i').html(checked);
        });
        $('.timer').startTimer({
            onComplete: function(){
                $('#sub').trigger('click');
            }
        });

        $('#sub').click(function(event) {
                var data = $('form#Demo').serialize();
                var url = '{{route('user.test-exam',':id')}}';
                url = url.replace(':id', id);
                $.ajax({
                    method:'post',
                    url: url,
                    data: data,
                    success : function(data){
                        
                        $('#amount').text(data.amount);
                        $('#rest').text(data.rest);
                        $('#count').text(data.count);                       
                        $('#questions_count').text(data.questions_count);
                        let answers = data.arrAnswer;
                        let corrects = data.arrCorrect;
                        $('#show').click(function(event) {
                            for(var item in answers) {
                                $('#input_'+answers[item]).css({'color':'red','font-weight':'bold'});
                            }
                            for(var item in corrects) {
                                $('#input_'+corrects[item]).css({'color':'blue','font-weight':'bold'});
                            }
                        });                       
                    }
                });
            });

    });
</script>
@endsection