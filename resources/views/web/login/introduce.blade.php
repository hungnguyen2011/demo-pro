@extends('web.home')
@section('title','Giới thiệu')
@section('content')
<style>
	.des p {
		font-size: 17px;
	}
</style>
<div class="col-sm-7 des">
	<h3 style="text-align: center;font-size: 30px;font-weight: bold;color: #000082">Giới thiệu</h3>
	<br>
        <p>Bạn cần kho bài tập, đề thi, đề kiểm tra bám sát chương trình học để ôn tập hoặc học trước chương trình?</p>
        <p>Bạn muốn thực hành luyện đề mỗi ngày để củng cố kiến thức, nâng cao kĩ năng và trau dồi kinh nghiệp làm bài?</p>
        <p>Bạn muốn có một diễn đàn nơi có thể trao đổi bài vở, học tập cùng nhiều bạn đồng trang lứa?</p>
        <p>Học tốt chính là điều mà bạn đang tìm kiếm!</p>
        <p>Học Tốt đem tới cho bạn hệ thống làm bài online tối ưu với bộ bài tập trắc nghiệm, đề thi, đề kiểm tra bám sát chương trình sách giáo khoa, giúp các bạn củng cố lại những kiến thức đã học và rèn luyện kỹ năng, tốc độ làm bài, hỗ trợ phát hiện những lỗ hổng kiến thức để bạn kịp sửa chữa và khắc sâu kiến thức. Hơn thế nữa, lịch sử và thành tích làm bài của bạn sẽ được Học Tốt ghi lại chi tiết như một cuốn nhật ký để bạn có thể theo dõi quá trình học tập và sự tiến bộ của bản thân. Chắc chắn rằng với sự đồng hành mỗi ngày của Học Tốt, việc học tập sẽ trở nên vô cùng hào hứng và hiệu quả!</p>
        <p>Hãy để Học Tốt tiếp thêm động lực và cảm hứng học tập cho bạn để tự tin chinh phục bầu trời tri thức!</p>
</div>
@endsection
@section('add')
@include('web.layout.footer')
@endsection
