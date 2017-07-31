
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login/Signup</title>

  <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
  <meta name="robots" content="noindex">

  <!-- Material Design Icons  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Roboto Web Font -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">

  <!-- App CSS -->
  <link type="text/css" href="{{ asset('assets/css/style.min.css')}}" rel="stylesheet">

</head>

<body class="login">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103231911-1', 'auto');
  ga('send', 'pageview');

</script>
    <div class="row">
      @yield('content')
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('assets/vendor/jquery.min.js')}}"></script>

  <!-- Bootstrap -->
  <script src="{{ asset('assets/vendor/tether.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap.min.js')}}"></script>

  <!-- AdminPlus -->
  <script src="{{ asset('assets/vendor/adminplus.js')}}"></script>

  <!-- App JS -->
  <script src="{{ asset('assets/js/main.min.js')}}"></script>

</body>

</html>
