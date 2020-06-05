@include('admin.layout.head')
<body>
@include('admin.layout.header')
@include('admin.layout.sidebar')
    <div id="main">
    <div class="w3-container">
     @yield('content') 
    </div>
  </div>
@yield('script')
</body>
<script>
    function w3_open() {
      document.getElementById("main").style.marginLeft = "15%";
      document.getElementById("mySidebar").style.width = "15%";
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("openNav").style.display = 'none';
    }
    function w3_close() {
      document.getElementById("main").style.marginLeft = "0%";
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("openNav").style.display = "inline-block";
    }
  </script>
</html>
