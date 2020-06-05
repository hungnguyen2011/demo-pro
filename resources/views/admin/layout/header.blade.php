  <div class="navbar navbar-inverse">
    <div class="container-fluid w3-teal"> 
      <ul class="nav navbar-nav">
        <li><button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button></li>
        <li class="active"><a href="#">Hoctot.com</a></li>
      </ul>
      @if(Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span>{{Auth::user()->full_name}}</a></li>
        <li>
          <a>
            <form action="{{route('admin.logout')}}" method="post">
              @csrf
              <button type="submit" style="border: none;background-color: #009688!important"><span class="glyphicon glyphicon-log-out"></span> Logout
              </button>
            </form>
          </a>
        </li>
      </ul>
      @endif
    </div>
  </div>
