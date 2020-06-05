@include('web.layout.head')
<body>
@include('web.layout.header')
<div class="row">
    <div class="col-sm-5">
        <img src="/image/background1.png" alt="">
    </div>
    
    @yield('content')
</div>
@yield('add')
</body>
</html>
