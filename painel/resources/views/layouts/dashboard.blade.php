<!DOCTYPE html>
<html class="bootstrap-layout">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard DBM</title>

  <meta name="robots" content="noindex">
  <link rel="icon" href="{{ asset('site/images/favicon.png')}}" type="image/x-icon">
  <!-- Material Design Icons  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Material Design Icons  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Roboto Web Font -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">

  <!-- App CSS -->
  <link type="text/css" href="{{ asset('assets/css/style.min.css')}}" rel="stylesheet">

  <!-- Charts CSS -->
  <link rel="stylesheet" href="{{ asset('site/css/morris.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.css')}}">

</head>

<body class="layout-container ls-top-navbar si-l3-md-up breakpoint-1200">
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
    <button class="navbar-toggler pull-xs-left hidden-lg-up active" type="button" data-toggle="sidebar" data-target="#sidebarLeft"><span class="material-icons">menu</span></button>

    <!-- Brand -->
    <a class="navbar-brand first-child-md" href="{{asset('adm/dashboard')}}">Dashboard DBM</a>

    <!-- Search -->
    <!--
    <form class="form-inline pull-xs-left hidden-sm-down">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn"><button class="btn" type="button"><i class="material-icons">search</i></button></span>
      </div>
    </form>
    -->
    <!-- // END Search -->

    <!-- Menu -->
    <ul class="nav navbar-nav pull-xs-right hidden-md-down">

      <!-- User dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
          <img src="{{ asset('site/images/person_perfil.png')}}" alt="Avatar" class="img-circle" width="40">
        </a>
        @if (!Auth::guest())
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-list" aria-labelledby="Preview">
            <a class="dropdown-item" href="{{asset('adm/perfil/')}}/{{Auth::user()->id}}">
              <i class="material-icons md-18">lock</i>
              <span class="icon-text">Editar Dados Pessoais</span>
            </a>

            <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
          </div>
        @endif
      </li>
      <!-- // END User dropdown -->

    </ul>
    <!-- // END Menu -->

  </nav>
  <!-- // END Navbar -->

  <!-- Sidebar -->
  <div class="sidebar sidebar-left si-si-3 sidebar-visible-md-up sidebar-dark bg-primary simplebar sidebar-visible" id="sidebarLeft" data-scrollable=""><div class="simplebar-track" style="display: none;"><div class="simplebar-scrollbar" style="top: 2px; height: 362px;"></div></div><div class="simplebar-scroll-content"><div class="simplebar-content">

    <!-- Brand -->
    <a href="{{asset('adm/dashboard')}}" class="sidebar-brand" style="height:100px;">
        <img class="img-responsive" width="170" height="90" src="{{asset('site/area-aluno/images/DBM-logo-white.png')}}" style="margin-top:5px;">
    </a>

    <!-- User -->
    <a href="#user-profile.html" class="sidebar-link sidebar-user">
      @if (!Auth::guest())
        <img src="{{ asset('site/images/person_perfil.png')}}" alt="user" class="img-circle">{{ Auth::user()->name }}</a>

        @if(Auth::user()->type == "default")
          <?php
            //EVITANDO QUE USUARIO DO TIPO ASSINANTE OU FREE TENHA ACESSO AO ADMINISTRADOR
            header('Location: '.asset('/area-aluno'));
            exit();
            ?>
        @endif

      @endif
    <!-- // END User -->

    <!-- Menu -->
    <ul class="sidebar-menu sm-bordered sm-active-button-bg">
      <li class="sidebar-menu-item active">
        <a class="sidebar-menu-button" href="{{asset('adm/dashboard')}}">
          <i class="sidebar-menu-icon material-icons">home</i> Dashboard
        </a>
      </li>

      <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" href="#ui-elements.html">
          <i class="sidebar-menu-icon material-icons">tune</i>CONFIGURAÇÕES</a>
        <ul class="sidebar-submenu">
          <!--
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="#ui-buttons.html">Cursos a Venda</a>
          </li>
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="#ui-cards.html">MailChimp</a>
          </li>
          -->
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{url('adm/pagseguro/list')}}">PagSeguro</a>
          </li>
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{asset('adm/configuracoes/rodape')}}">Rodapé</a>
          </li>
        </ul>
      </li>

      <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" href="#">
          <i class="sidebar-menu-icon material-icons">assignment</i> <span>Páginas</span>
        </a>
        <ul class="sidebar-submenu">
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{asset('adm/homepage')}}">Home</a>
          </li>
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{asset('adm/dbmcurso')}}">O Curso</a>
          </li>
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{asset('adm/profissionais')}}">Profissionais</a>
          </li>
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="#learning-dashboard.html">DBMicos</a>
          </li>
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{asset('adm/galerias')}}">Galeria</a>
          </li>
          <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{asset('adm/contatos')}}">Contatos</a>
          </li>

        </ul>
      </li>

      <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" href="#">
          <i class="material-icons">important_devices</i> Vídeos Aulas
        </a>
        <ul class="sidebar-submenu">
            <li class="sidebar-menu-item">
              <a class="sidebar-menu-button" href="{{asset('adm/videoaulas/listar')}}">Listar Todas</a>
            </li>
            <li class="sidebar-menu-item">
            	<a class="sidebar-menu-button" href="{{asset('adm/videoaulas/conteudo-presencial')}}">
            		Conteúdo Presencial
            	</a>
            </li>
            <li class="sidebar-menu-item">
              <a class="sidebar-menu-button" href="{{asset('adm/professors')}}">Professores</a>
            </li>
            <li class="sidebar-menu-item">
              <a class="sidebar-menu-button" href="{{asset('adm/categories')}}">Categorias</a>
            </li>
            <li class="sidebar-menu-item">
              <a class="sidebar-menu-button" href="{{asset('adm/reviews/listar')}}">Avaliações de Aluno</a>
            </li>
        </ul>
      </li>

      <li class="sidebar-menu-item">
        <a class="sidebar-menu-button" href="#">
          <i class="material-icons">supervisor_account</i> Administrar Usuários
        </a>
        <ul class="sidebar-submenu">
            <li class="sidebar-menu-item">
              <a class="sidebar-menu-button" href="{{asset('adm/users')}}">Listar Todos</a>
            </li>
			<li class="sidebar-menu-item">
              <a class="sidebar-menu-button" href="{{asset('adm/presenciais/listar')}}">Alunos Presenciais</a>
            </li>
        </ul>
      </li>

    </ul>
    <!-- // END Menu -->

    <!-- Activity -->


    <!-- // END Activity -->

    <!-- Stats -->
    <div class="sidebar-stats">
      <div class="sidebar-stats-lead text-primary">
      <?php  $pedidospagos = Session::get('pedidospagos');?>
        <span> <?php echo ( count($pedidospagos) > 0)? count($pedidospagos) : 0;?> </span>
        <small class="text-success">
          <i class="material-icons md-middle">arrow_upward</i>

        </small>
      </div>
      <small>TOTAL PEDIDOS</small>
    </div>
    <!-- // END Stats -->

  </div>
</div>
</div>
  <!-- // END Sidebar -->

  <!-- Right Sidebars -->

  <!-- Content -->
  <div class="layout-content simplebar" data-scrollable="">
      <div class="simplebar-track" style="display: none;">
        <div class="simplebar-scrollbar" style="top: 90px; height: 298px;">
        </div>
      </div>

      <div class="simplebar-scroll-content">
          <div class="simplebar-content">

            @yield('content')

          </div>
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

  <!-- Theme Colors -->
  <script src="{{ asset('assets/js/colors.js')}}"></script>

  <!-- Charts JS -->
  <script src="{{ asset('assets/vendor/raphael.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/morris.min.js')}}"></script>

  <!-- Initialize Charts -->
  <script src="{{ asset('examples/js/chart.js')}}"></script>


  <script>

    function delBanner(ID) {
        var txt;
        var r = confirm("Deseja realmente apagar este Banner?");
        if (r == true) {
        window.location.href="{{asset('adm/banner/destroy')}}/"+ID;
            alert("Apagado com sucesso!");
        } else {
        txt = "You pressed Cancel!";
        }

    }

    function delDegustacao(ID) {
        var txt;
        var r = confirm("Deseja realmente apagar este Conteúdo?");
        if (r == true) {
        window.location.href="{{asset('adm/degustacao/destroy')}}/"+ID;
            alert("Apagado Degustação com sucesso!");
        } else {
        txt = "You pressed Cancel!";
        }

    }
    function delDbmnumero(ID){
      var txt;
      var r = confirm("Deseja realmente apagar este Conteúdo?");
      if (r == true) {
      window.location.href="{{asset('adm/dbmnumero/destroy')}}/"+ID;
          alert("Apagado DBM Número com sucesso!");
      } else {
      txt = "You pressed Cancel!";
      }
    }
    function delDepoimento(ID){
      var txt;
      var r = confirm("Deseja realmente apagar este Conteúdo?");
      if (r == true) {
      window.location.href="{{asset('adm/depoimentos/destroy')}}/"+ID;
          alert("Apagado depoimento com sucesso!");
      } else {
      txt = "You pressed Cancel!";
      }
    }

    function delGaleria(ID){
      var txt;
      var r = confirm("Deseja realmente apagar este Conteúdo da Galeria?");
      if (r == true) {
      window.location.href="{{asset('adm/galerias/destroy')}}/"+ID;
          alert("Apagado conteudo com sucesso!");
      } else {
      txt = "You pressed Cancel!";
      }
    }

    function delProfissional(ID){
      var txt;
      var r = confirm("Deseja realmente apagar este profissional?");
      if (r == true) {
      window.location.href="{{asset('adm/profissionais/destroy')}}/"+ID;
          alert("Apagado conteudo com sucesso!");
      } else {
      txt = "You pressed Cancel!";
      }
    }

    function delDbmcurso(ID){
      var txt;
      var r = confirm("Deseja realmente apagar este conteudo?");
      if (r == true) {
      window.location.href="{{asset('adm/dbmcurso/destroy')}}/"+ID;
          alert("Apagado conteudo com sucesso!");
      } else {
      txt = "You pressed Cancel!";
      }
    }

    function delCategory(ID){
      var txt;
      var r = confirm("Deseja realmente apagar esta categoria?");
      if (r == true) {
      window.location.href="{{asset('adm/categories/destroy')}}/"+ID;
          alert("Apagado conteudo com sucesso!");
      } else {
      txt = "You pressed Cancel!";
      }
    }

    function delProfessor(ID){
      var txt;
      var r = confirm("Deseja realmente apagar este professor?");
      if (r == true) {
      window.location.href="{{asset('adm/professors/destroy')}}/"+ID;
          alert("Apagado conteudo com sucesso!");
      } else {
      txt = "You pressed Cancel!";
      }
    }
  </script>
  
  <!-- RECURSO DE MULTI UPLOAD -->
  	<script src="{{asset('fileinput/plugins/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('fileinput/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('fileinput/locales/pt-BR.js')}}" type="text/javascript"></script>

</body>

</html>
