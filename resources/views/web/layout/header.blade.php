<div class="container-fluid" style="background-color: #f3f8fc">
  <div style="min-height: 120px">
    <div class="navbar-header" style="min-height: 100px">
      <a class="navbar-brand" href="{{ route('user.recomend') }}"><img src="/image/title.png" alt=""></a>
    </div>
    <ul class="nav navbar-nav navbar-right" style="padding-top: 40px">
      <li><a href="{{ route('user.test') }}">Luyện thi</a></li>
{{--       <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tài liệu <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Lớp 10</a></li>
          <li><a href="#">Lớp 11</a></li>
          <li><a href="#">Lớp 12</a></li>
        </ul>
      </li> --}}
      <li><a href="{{ route('user.introduce') }}">Giới thiệu</a></li>
      @if(Auth::check() && Auth::user()->type == 2)
      <li><a href="{{ route('user.infor',Auth::user()->id) }}">Thông tin cá nhân</a></li>
      <li><a>
        <form action="{{ route('user.logout') }}" method="post">
          @csrf
          <button type="submit" style="border: none"><span class="glyphicon glyphicon-log-out"></span></button>
        </form>
        </a>
      </li>
      @else
      <li><a href="{{ route('user.sign-up-form') }}">Đăng kí</a></li>
      <li><a href="{{ route('user.login-form') }}">Đăng Nhập</a></li>
      @endif
    </ul>
  </div>
</div>