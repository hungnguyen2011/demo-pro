@extends('admin.index')
@section('title','Sửa bài thi')
@section('content')
<style>
    td.weight {
        font-weight: bold;
    }
    tr td {
        border: none !important;
    }
    .table {
        border: 1px solid #dacfcf;
    }
    .error {
        color: red;
        font-size: 12px;
    }
</style>
<div>
    <h2>Chỉnh sửa Bài thi</h2>  
    <div class="row" style="margin-top: 50px"> 
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <form  id="exam-form-data" action="{{route('admin.exam.edit-exam',['id'=>$id,'id1'=>$exam->id])}}" method="post">
                @csrf
                <table class="table">
                    <tbody>
                        <input type="hidden" name="subject_id" value="{{$id}}">
                        <tr>
                            <td class="weight">Tên bài thi<span class="text-danger">(*)</span></td>
                            <td> <input type="text" class="form-control" name="exam_name" value="{{$exam->exam_name}}">
                            </td>
                        </tr>
                        <tr>
                            <td class="weight">Thời gian làm bài<span class="text-danger">(*)</span></td>
                            <td> <input type="text" class="form-control" name="duration" value="{{$exam->duration}}">
                            </td>
                        </tr>
                        <tr>
                            <td class="weight">Mô tả bài thi<span class="text-danger">(*)</span></td>
                            <td> <textarea class="form-control" rows="5" name="description">{{$exam->description}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="">
                                <a href="{{route('admin.exam.list-exam',$id)}}" class="btn btn-primary bg-secondary">Hủy</a>
                                <button class="btn btn-primary" type="submit" >Thêm</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>
</div>
@endsection

@section('script')
<script>
    $("#exam-form-data").validate({
        ignore: [],
            onkeyup: function(ele) {
                $(ele).valid();
        },
        rules: {
            "exam_name": {
                required: true,
            },
            "duration": {
                required: true,
                number: true,
            },
            "description": {
                required: true,
            },
        }
    });
</script>
@endsection