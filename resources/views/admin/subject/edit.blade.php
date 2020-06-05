@extends('admin.index')
@section('title','')
@section('content')
<style>
	td.weight {
		font-weight: bold;
	}
	tr td {
    	border: none !important;
  	}
  	.error {
        color: red;
        font-size: 12px;
    }
</style>
<h2>Sửa Môn học</h2>
<div class="row" style="margin-top: 50px"> 
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<form  id="subject-form-data" action="" method="post" enctype="multipart/form-data">
	    @csrf
		    <table class="table">
		      <tbody>
                <input type="hidden" class="subject_id" value="{{$subject->id}}">
		        <tr>
		          <td class="weight">Môn học<span class="text-danger">(*)</span></td>
		          <td> <input type="text" class="form-control" name="subject_name" value="{{$subject->subject_name}}">
		          </td>
		        </tr>
		        <tr>
		          <td class="weight">Ảnh môn học<span class="text-danger">(*)</span></td>
		          <td>
		            <input type="file" class="form-control-file" name="image" value="" onchange="encodeImageFileAsURL(this)">
		            <img id="preview" src="{{asset('storage'.$subject->image)}}"  width="100px" style="padding-top: 25px">
		          </td>
		        </tr>
		        <tr>
          			<td></td>
          			<td class="">
		            <a href="{{route('admin.subject.list')}}" class="btn btn-primary bg-secondary">Hủy</a>
		            <button class="btn btn-primary" type="submit">Chỉnh sửa</button>
          			</td>
        		</tr>
		      </tbody>
		    </table>
  		</form>
	</div>
	<div class="col-sm-1"></div>
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
    let id = $('.subject_id').val();
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
                data: {"id":id,"subject_name": value},
                success: function(data) {
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