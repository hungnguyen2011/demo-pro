<style>
  ul li a span {
    font-size: 22px;
    margin-left: -15px;
  }
</style>
<div class="container-fluid" style="background-color: #f3f8fc">
  <div style="min-height: 120px">
    <div class="navbar-header" style="min-height: 100px">
      <a class="navbar-brand" href="{{ route('user.recomend') }}"><img src="/image/title.png" alt=""></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      @if(Auth::check() && Auth::user()->type == 2)
      <li><a href="{{ route('user.infor',Auth::user()->id) }}"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->full_name}}</a></li>
      <li><a>
        <form action="{{ route('user.logout') }}" method="post">
          @csrf
          <button type="submit" style="border: none"><span class="glyphicon glyphicon-log-out"></span></button>
        </form>
        </a>
      </li>
      @endif
    </ul>

  </div>
</div>