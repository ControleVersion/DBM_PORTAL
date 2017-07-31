<!DOCTYPE html>
<html lang="pt-br" class="wide wow-animation smoothscroll scrollTo">
<head>
<title>Portal Da Bioquímica à Mesa</title>
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="date" content="Dec 31">
<link rel="icon" href="{{ asset('site/images/favicon.png')}}" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="{{ asset('site/css/css.css?family=Open+Sans:400,300italic,300,400italic,600,700%7CMerriweather:400,300,300italic,400italic,700,700italic')}}">
<link rel="stylesheet" href="{{ asset('site/css/style.css')}}">
<!-- css DBM -->
<link rel="stylesheet" type="text/css" href="{{ asset('site/css/DBM.css')}}">
<!-- css jqvmap -->
<link rel="stylesheet" type="text/css" href="{{ asset('site/css/jqvmap.min.css')}} ">
<!-- css player -->
<link rel="stylesheet" href="https://cdn.plyr.io/2.0.12/plyr.css">
<!-- altera a cor do navegador -->
<meta name="theme-color" content="#1072C0">
<meta name="apple-mobile-web-app-status-bar-style" content="#1072C0">
<meta name="msapplication-navbutton-color" content="#1072C0">
<!-- altera a cor do navegador -->
<!-- Plyr -->
<link rel="stylesheet" href="https://cdn.plyr.io/2.0.12/plyr.css">

</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103231911-1', 'auto');
  ga('send', 'pageview');

</script>
<div class="page text-center">
  <header class="page-head header-panel-absolute">
    <div class="rd-navbar-wrap">
      <nav data-md-device-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-stick-up-offset="210" data-xl-stick-up-offset="85" class="rd-navbar rd-navbar-default" data-lg-auto-height="true" data-auto-height="false" data-md-layout="rd-navbar-static" data-lg-layout="rd-navbar-static" data-lg-stick-up="true">
        <div class="rd-navbar-inner">
          <div class="rd-navbar-panel">
            <button data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap" class="rd-navbar-toggle">
              <span></span>
            </button>
            <!-- acrescenta a imagem mobile  -->
            <!-- logo dbm mobile -->
            <button id="mobileLogo" class="rd-navbar-top-panel-toggle veil-md"></button>
            <!-- logo dbm mobile -->
            <!-- acrescenta a imagem mobile  -->
          </div>

          <div class="rd-navbar-menu-wrap clearfix gray-line">
            <div class="rd-navbar-brand">
              <a href="{{asset('/')}}" class="reveal-inline-block">
              <div class="unit unit-xs-middle unit-xl unit-xl-horizontal unit-spacing-xxs">
                <!-- logo -->
                <div class="unit-left">
                  <img width='276' height='140' src='{{ asset('site/images/logo-header-250x150.png')}}'/>
                </div>
                <!-- logo -->
              </div>
              </a>
            </div>

            <div class="rd-navbar-nav-wrap">
              <div class="rd-navbar-mobile-scroll">
                <ul class="rd-navbar-nav">
                  <li id="home" class="active">
                    <a href="{{asset('/')}}">Home</a>
                  </li>
                  <li id="dbm-curso">
                    <a href="{{ asset('dbm-curso') }}">O Curso</a>
                  </li>
                  <li id="profissionais">
                    <a href="{{ asset('profissionais') }}">Profissionais</a>
                    <ul class="rd-navbar-dropdown" id="menu-profissionais">
                      <!-- estrutura básica para link profissinal
                      <li>
                        <a href="{{url('profissionais')}}#1">Dr. Murilo Pereira</a>
                      </li>
                      <li>
                        <a href="{{url('profissionais')}}#2">Dr. Henrique Freitas</a>
                      </li>
                      <li>
                        <a href="{{url('profissionais')}}#3">Dra. Isis Moreira</a>
                      </li>
                      -->
                    </ul>
                  </li>
                  <li id="dbmicos">
                    <a href="{{asset('dbmicos')}}">BDMicos</a>
                  </li>

                  <li id="galeria">
                    <a href="{{asset('galeria')}}"><span class="fa-camera nav-icon"></span>Galeria</a>
                  </li>
                  <li id="contato">
                    <a href="{{asset('/contato')}}">Contatos</a>
                  </li>
                  <li id="registro">
                    <a href="{{asset('/registro')}}"><span class="fa-user nav-icon"></span>Login</a>
                  </li>
                  @if(count(Session::get('videoaula')) > 0)
                  <li>
                    <a href="{{asset('comprar')}}" class="btn-comprar">
                        <span class="fa-shopping-cart nav-icon"></span>
                        Comprar
                    </a>
                  </li>
                  @endif

                </ul>
              </div>
            </div>

          </div>
        </div>
      </nav>
    </div>
  </header>
  <?php
    $emailEmpresa = "";
    $telefoneEmpresa = "";
    $facebookEmpresa = "";
    $instagramEmpresa="";
    //resgatando o objeto armazenado na rota Session
    $empresaInfo = Session::get('empresaInfo');
    foreach($empresaInfo as $empresa){
      $emailEmpresa = $empresa->email_contato;
      $telefoneEmpresa = $empresa->telefone;
      $facebookEmpresa = $empresa->facebook;
      $instagramEmpresa = $empresa->instagram;
    }
  ?>
    @yield('content')

  <!--  Novo Footer -->
  <footer id="DBMfooter" class="page-footer" style="padding-top:20px;">
    <div class="shell-wide">
      <div class="hr bg-gray-light"></div>
    </div>
    <div class="shell section-60">
      <div class="range range-lg-justify range-xs-center">
        <div class="cell-md-3 cell-lg-3 ">
          <a href="{{asset('/')}}" class="reveal-inline-block">
          <img width="276" height="140" src="{{asset('site/images/logo-header-250x150.png')}}" alt=""></a>
        </div>

        <div class="cell-xs-10 cell-md-3 cell-lg-3 text-lg-left offset-top-50 offset-md-top-0">
          <h6 class="text-bold">Parceiros</h6>
          <div class="text-subline"></div>
          <div class="offset-top-30">
            <ul class="list-unstyled list">
              <li>
                <div class="cell-md-1 cell-lg-3">
                  <a href="https://www.vponline.com.br/site/" class="reveal-inline-block ">
                  <img class="parceiro-logo" width="140" height="70" src="{{asset('site/images/vp-logo.png')}}" alt=""></a>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="cell-xs-10 cell-md-3 cell-lg-3 text-lg-left offset-top-50 offset-md-top-0">
          <h6 class="text-bold">Entre em contato</h6>
          <div class="text-subline"></div>
          <div class="offset-top-30">
            <ul class="list-unstyled contact-info list">
              <li>
                <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                  <div class="unit-left"><span class="icon mdi mdi-phone text-middle icon-xs text-madison"></span></div>
                  <div class="unit-body">
                    <a id="DBMphone" href="tel:{{$telefoneEmpresa}}" class="text-dark">{{$telefoneEmpresa}}</a>
                  </div>
                </div>
              </li>
              <li class="offset-top-15">
                <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                  <div class="unit-left"><span class="icon mdi mdi-email-open text-middle icon-xs text-madison"></span></div>
                  <div class="unit-body">
                    <a id="DBMemail" href="mailto:{{$emailEmpresa}}">{{$emailEmpresa}}</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="offset-top-15 text-left">
            <ul class="list-inline list-inline-xs list-inline-madison">
              <li><a href="{{$facebookEmpresa}}" class="icon icon-xxs fa-facebook icon-circle icon-gray-light-filled"></a></li>
              <li><a href="{{$instagramEmpresa}}" class="icon icon-xxs fa-instagram icon-circle icon-gray-light-filled"></a></li>
            </ul>
          </div>
        </div>

        <!-- =============================================================
        <div class="offset-top-10">
            <form data-form-output="form-subscribe-footer" data-form-type="subscribe" method="post" action="" class="rd-mailform form-subscribe" novalidate="novalidate">
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <input id="degustSubscribeFooter" placeholder="Seu e-mail" type="email" name="email" data-constraints="@Required @Email" class="form-control  form-control-has-validation"><span class="form-validation"></span>
                  <span class="input-group-btn">
                  <button type="submit" class="btn btn-sm btn-primary" onclick="recuperaEmailFooter();">Inscrever</button>
                  </span>
                </div>
              </div>
              <div id="form-subscribe-footer" class="form-output"></div>
            </form>
          </div>
         ============================================================= -->

        <div class="cell-xs-10 cell-md-3 cell-lg-3 text-lg-left offset-top-50 offset-lg-top-0">
          <h6 class="text-bold">DBM News</h6>
          <div class="text-subline"></div>
          <div class="offset-top-30 text-left">
            <p>Fique sabendo de todas as novidades do DBM e eventos especiais para você.</p>
          </div>
          <div class="offset-top-10">

            <form id="newsletter" class="form-horizontal rd-mailform form-subscribe" action="#" method="POST"  accept-charset="utf-8">
              <div class="form-group">
                <div class="input-group input-group-sm">
                    {!! csrf_field() !!}
                       <input placeholder="Seu e-mail" value="" type="email" name="email"  class="form-control degustSubscribe" required>
                       <span class="input-group-btn">
                         <button id="form-mailChimp" type="button" class="btn btn-sm btn-primary">Inscrever</button>
                       </span>
                </div>
              </div>
              <div id="form-subscribe-footer" class="form-output"></div>
            </form>
            <div id="sucesso-error" style="display: none;">Cadastrado com sucesso!</div>
            <script type="text/javascript">
              setTimeout(function(){
                jQuery('#form-mailChimp').click(function(){
                    var ramo, token, url, data;
                    token = $('input[name=_token]').val();
                    email = $('form#newsletter input[name=email]').attr('value');
                    url = '{{ url("/") }}/subscribe';
                    data = {email: email};
                    if(email != ""){
                        $.ajax({
                            url: url,
                            headers: {'X-CSRF-TOKEN': token},
                            data: data,
                            type: 'POST',
                            datatype: 'JSON',
                            success: function (resp) {
                                console.log(resp);
                                var data = JSON.parse(resp);
                                //alert(resp);
                                $('input[name="email"]').attr('value','');
                                if(data.retorno == 'falha'){
                                  $('#form-mailChimp').prop('disabled', false);
                                  $('#sucesso-error').show();
                                  $('#sucesso-error').html('<span style="color:red;">Email já cadastrado ou inválido.</span>');
                                }else {
                                  $('#form-mailChimp').prop('disabled', true);
                                  $('#sucesso-error').show();
                                  $('#sucesso-error').html('<span style="color:green;">Cadastro realizado com sucesso.</span>');
                                }
                            }
                        });
                    }
                });
              }, 2000);
            </script>

          </div>
        </div>
        <!-- ====== FIM DA NEWSLETTER ====== -->

      </div>
    </div>
    <div class="bg-madison context-dark">
      <div class="shell text-md-left section-15">
        <p>© <span id="copyright-year">2017</span> Todos os direitos reservados a DBM. <a href="#termos-uso.html" id="termo-uso-link">Termos de uso site</a></p>
      </div>
    </div>
  </footer>


</div>
<div id="form-output-global" class="snackbars"></div>
<div tabindex="-1" role="dialog" aria-hidden="true" class="pswp">
  <div class="pswp__bg"></div>
  <div class="pswp__scroll-wrap">
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>
    <div class="pswp__ui pswp__ui--hidden">
      <div class="pswp__top-bar">
        <div class="pswp__counter"></div>
        <button title="Close (Esc)" class="pswp__button pswp__button--close"></button>
        <button title="Share" class="pswp__button pswp__button--share"></button>
        <button title="Toggle fullscreen" class="pswp__button pswp__button--fs"></button>
        <button title="Zoom in/out" class="pswp__button pswp__button--zoom"></button>
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>
      <button title="Previous (arrow left)" class="pswp__button pswp__button--arrow--left"></button>
      <button title="Next (arrow right)" class="pswp__button pswp__button--arrow--right"></button>
      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('site/js/core.min.js')}}"></script>
<script src="{{ asset('site/js/script.js')}}"></script>
<!-- funcionamento do video por demanda -->
<script src="{{ asset('site/js/videoDBM.js')}}"></script>

<script src="{{ asset('site/js/scrollSuave.js')}}"></script>
<script src="{{ asset('site/js/carouselChange.js')}}"></script>
<script src="{{ asset('site/js/recuperaEmail.js')}}"></script>
<script src="{{asset('site/js/jquery.maskedinput.js')}}"></script>

<script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflHJ3SDg/www-widgetapi.js" async=""></script>
<!-- <script src="https://www.youtube.com/iframe_api"></script>
<script src="https://cdn.plyr.io/2.0.12/plyr.js"></script>
<script src="https://cdn.plyr.io/2.0.12/demo.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script>
  //validar CPF

  $.validator.addMethod('cpf',function(value,element,param) {
         $return = true;

         // this is mostly not needed
         var invalidos = [
              '111.111.111-11',
              '222.222.222-22',
              '333.333.333-33',
              '444.444.444-44',
              '555.555.555-55',
              '666.666.666-66',
              '777.777.777-77',
              '888.888.888-88',
              '999.999.999-99',
              '000.000.000-00'
          ];
          for(i=0;i<invalidos.length;i++) {
              if( invalidos[i] == value) {
                  $return = false;
              }
          }

          value = value.replace("-","");
          value = value.replace(/\./g,"");

          //validando primeiro digito
          add = 0;
          for ( i=0; i < 9; i++ ) {
              add += parseInt(value.charAt(i), 10) * (10-i);
          }
          rev = 11 - ( add % 11 );
          if( rev == 10 || rev == 11) {
              rev = 0;
          }
          if( rev != parseInt(value.charAt(9), 10) ) {
              $return = false;
          }

          //validando segundo digito
          add = 0;
          for ( i=0; i < 10; i++ ) {
              add += parseInt(value.charAt(i), 10) * (11-i);
          }
          rev = 11 - ( add % 11 );
          if( rev == 10 || rev == 11) {
              rev = 0;
          }
          if( rev != parseInt(value.charAt(10), 10) ) {
              $return = false;
          }

          return $return;
      });


   var $cpf = $("#id_cpf").attr("name");
  var $params = {debug:false, rules:{}, messages:{}};
  $params['rules'][$cpf] = "cpf";
  $params['messages'][$cpf] = "CPF inv&aacute;lido";

  $("#form-registrar").validate($params);

  //mascara registro
  $("form#form-registrar input[name=cpf]").mask("999.999.999-99");

/*
  TRATANDO O ACTIVE DO MENU
*/
  function ativarMenu(tela){
      var url = window.location.href;
      var string = url,
          substring = tela;
      if(string.indexOf(substring) !== -1){
          jQuery('#dbm-curso,#profissionais,#dbmicos,#galeria,#contato,#registro,#home').attr('class', '');
          jQuery('#'+tela).attr("class", 'active');
          if(tela == 'profissionais'){
            jQuery('#'+tela).addClass('rd-navbar--has-dropdown rd-navbar-submenu');
          } else {
            jQuery('#profissionais').addClass('rd-navbar--has-dropdown rd-navbar-submenu');
          }
      }
  }

  var url = window.location.href;
  var string = url;
  if(string.indexOf("dbmicos") !== -1){
    var imported = document.createElement('script');
    imported.src = '{{asset('site')}}/js/jquery.vmap.js';
    jQuery('footer').append(imported);

    var imported2 = document.createElement('script');
    imported2.src = '{{asset('site')}}/js/jquery.vmap.brazil.js';
    jQuery('footer').append(imported2);

    var imported3 = document.createElement('script');
    imported3.src = '{{asset('site')}}/js/br-map.js';
    jQuery('footer').append(imported3);
  }

  //carregar Menu de Profissionais
  jQuery.ajax({
    url: '{{asset('/')}}/get-menu-profissionais',
    type:'get',
    datatype: 'html',
    success: function(dados){
      console.log(dados);
      jQuery('#menu-profissionais').html(dados);
    }
  });

</script>

<script type="text/javascript" src="{{asset('site/js/example-jquery-bar-rating.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jquery.barrating.js')}}"></script>

</body>
</html>
