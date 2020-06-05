@extends('admin.index')
@section('title','Quản lí môn học')
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
    <h2>Thêm môn học</h2>  
    <div class="row" style="margin-top: 50px"> 
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <form  id="subject-form-data" action="{{route('admin.subject.add-subject')}}" method="post" enctype="multipart/form-data">
                @csrf
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="weight">Tên Môn học<span class="text-danger">(*)</span></td>
                            <td> <input type="text" class="form-control" name="subject_name" value="">
                            </td>
                        </tr>
                        <tr>
                            <td class="weight">Ảnh môn học<span class="text-danger">(*)</span></td>
                            <td>
                                <input type="file" class="form-control-file" name="image" value="" onchange="encodeImageFileAsURL(this)">
                                <img id="preview" src=""  width="100px" style="padding-top: 25px">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="">
                                <a href="{{route('admin.subject.list')}}" class="btn btn-primary bg-secondary">Hủy</a>
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
    function encodeImageFileAsURL(element) {
        $(element).valid();
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
          $('#preview').attr('src', reader.result);
      }
      reader.readAsDataURL(file);
    }

    $.validator.addMethod("verifySubject",function(value, element) {
            let result = false;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                async: false,
                url: "{{route('admin.subject.subject')}}",
                data: {"subject_name": value},
                success: function(data) {
                    console.log(data);
                    result = (data == true) ? false : true;
                }
            });
            return result;
        },'This subject name already exists');

    $("#subject-form-data").validate({
        ignore: [],
            onkeyup: function(ele) {
                $(ele).valid();
        },
        rules: {
            "subject_name": {
                required: true,
                verifySubject: true,
            },
            "image": {
                extension: "jpeg,png,jpg",
            },
        }
    });
</script>
@endsection
