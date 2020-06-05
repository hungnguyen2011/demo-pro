@include('web.layout.head')
<body>
@include('web.layout.header-index')
<div class="row">
    @yield('content')
</div>
<div style="padding-top: 30px">
@include('web.layout.footer')
</div>
@yield('script')
</body>
</html>
