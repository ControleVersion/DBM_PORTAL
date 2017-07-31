<!DOCTYPE html>
<html class="bootstrap-layout">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Da Bioquímica à Mesa</title>

<meta name="robots" content="noindex">
<!-- Material Design Icons  -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="icon" href="{{ asset('site/images/favicon.png')}}" type="image/x-icon">
<!-- Roboto Web Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
<!-- App CSS -->
<link type="text/css" href="{{asset('site/area-aluno/assets/css/style.min.css')}}" rel="stylesheet">
<!-- Charts CSS -->
<link rel="stylesheet" href="{{asset('site/area-aluno/assets/css/morris.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('site/assets/css/DBM_restrito.css')}}">
<!-- altera a cor do navegador -->
<meta name="theme-color" content="#1072C0">
<meta name="apple-mobile-web-app-status-bar-style" content="#1072C0">
<meta name="msapplication-navbutton-color" content="#1072C0">
<!-- altera a cor do navegador -->

<!-- Plyr -->
<link rel="stylesheet" href="https://cdn.plyr.io/2.0.12/plyr.css">

<style type="">
  .videoTitle{
    margin-top: 10px;
  }
</style>

</head>

<body class="layout-container ls-top-navbar si-l3-md-up">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103231911-1', 'auto');
  ga('send', 'pageview');

</script>
  <!-- Navbar -->
  <nav class="navbar navbar-light bg-white navbar-full navbar-fixed-top ls-left-sidebar">

    <!-- Sidebar toggle -->
    <button class="navbar-toggler pull-xs-left hidden-lg-up" type="button" data-toggle="sidebar" data-target="#sidebarLeft"><span class="material-icons">menu</span></button>

    <!-- Brand -->
    <a class="navbar-brand first-child-md" href="#"></a>

    <!-- Menu -->
    <ul class="nav navbar-nav pull-xs-right hidden-md-down">
      <!-- User dropdown -->
      <li class="nav-item dropdown">
      <?php
    		$idUser = Auth::user()->id;
    		$perfil = \DB::table('alunos')->where('user_id', '=',$idUser)->get(); 
    		$imgPerfil = (isset($perfil[0]->img_perfil))? $perfil[0]->img_perfil : '';
    	?>
    	@if($imgPerfil != '')
    		
    		<a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false">
          		<img src="{{asset('/').$imgPerfil}}" alt="Avatar" class="img-circle" width="40" height="40">
        	</a>
    	@else
    		<a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false">
          		<img src="{{asset('site/images/person_perfil.png')}}" alt="Avatar" class="img-circle" width="40">
        	</a>
    	@endif
        
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-list" aria-labelledby="Preview">
          <a class="dropdown-item" href="{{asset('area-aluno/perfil')}}/{{Auth::user()->id}}">
            <i class="material-icons md-18">person</i>
            <span class="icon-text">Meu Perfil</span>
          </a>
          <a class="dropdown-item" href="{{asset('logout')}}">Sair</a>
        </div>
      </li>

      <!-- / END User dropdown -->

    </ul>
    <!-- // END Menu -->
    <div class="dropdown-menu-left" style="display: block; margin-left: 29px;">
      <small>Seja bem vindo <b>{{Auth::user()->name}} </b> </small>
    </div>
  </nav>
  <!-- // END Navbar -->

  <!-- Sidebar -->
  <div class="sidebar sidebar-left si-si-3 sidebar-visible-md-up sidebar-dark bg-primary" id="sidebarLeft" data-scrollable>

    <!-- Brand -->

    <a href="{{asset('/area-aluno/')}}" class="sidebar-brand" style="height:100px;">
        <img class="img-responsive" width="170" height="90" src="{{asset('site/area-aluno/images/DBM-logo-white.png')}}" style="margin-top:5px;">
    </a>

    <!-- Menu -->
    <ul class="sidebar-menu sm-bordered sm-active-button-bg">

      <!-- videos aula ao vivo-->
      <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" href="#">
          <i class="sidebar-menu-icon material-icons">videocam</i> Aula ao vivo
        </a>
      </li>
      <!-- videos aula ao vivo -->

      <!-- videos grávados-->
      <li class="sidebar-menu-item  active">
        <a class="sidebar-menu-button" href="#">
          <i class="sidebar-menu-icon material-icons">subscriptions</i> Videos
        </a>
        <ul class="sidebar-submenu " >
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{asset('/area-aluno/videos')}}">Gratuitos</a>
          </li>
        </ul>
        <ul class="sidebar-submenu " >
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{asset('/area-aluno/cursos')}}">Meus Cursos</a>
          </li>
        </ul>

      </li>
      <!-- videos grávados-->
  </div>
  <!-- // END Sidebar -->
  <!-- Right Sidebars -->
  <!-- Content -->
  <div class="layout-content" data-scrollable>
    <div class="container-fluid">
      <!-- Row -->
      @yield('content')
      <!-- // END Row -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{asset('site/area-aluno/assets/vendor/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('site/area-aluno/assets/vendor/tether.min.js')}}"></script>
  <script src="{{asset('site/area-aluno/assets/vendor/bootstrap.min.js')}}"></script>
  <!-- AdminPlus -->
  <script src="{{asset('site/area-aluno/assets/vendor/adminplus.js')}}"></script>
  <!-- App JS -->
  <script src="{{asset('site/area-aluno/assets/js/main.min.js')}}"></script>
  <!-- Theme Colors -->
  <script src="{{asset('site/area-aluno/assets/js/colors.js')}}"></script>
  <!-- ================================= -->
  <!-- Plyr core script -->
  <script src="https://cdn.plyr.io/2.0.12/plyr.js"></script>
  <!-- Docs script -->
  <script src="https://cdn.plyr.io/2.0.12/demo.js"></script>
  <!-- Rangetouch to fix <input type="range"> on touch devices (see https://rangetouch.com) -->
  <script src="https://cdn.rangetouch.com/0.0.9/rangetouch.js"></script>
  <!-- ================================= -->
  <!-- Initialize Charts -->
  <script src="{{asset('examples/js/chart.js')}}"></script>
  <script src="{{asset('site/js/sweetalert.js')}}"></script>
  <!-- definições player -->
  <script src="{{asset('site/js/dbmvervideo.js')}}"></script>
</script>

</body>

</html>
