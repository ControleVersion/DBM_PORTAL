@extends('layouts.site.site')

@section('content')
<!-- adicionar o carrosel -->

<main class="page-content">
<section>
  <div data-height="42.1875%" data-loop="true" data-dragable="false" data-min-height="480px" data-slide-effect="true" class="swiper-container swiper-slider">
    <div class="swiper-wrapper">

      @foreach ($banners as $value)
          <!-- carousel-1 -->
          <div id="landPageMainImg" data-slide-bg="{{asset('/')}}/{{$value->url_imagem}}" style="background-position: 80% center" class="swiper-slide">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="range range-xs-center range-lg-center ">
                  <div class="cell-md-9 text-center cell-xs-10">
                    <div data-caption-animate="fadeInUp" data-caption-delay="100">
                      <h1 id="landPageMainTXT" class="text-bold">
                          {{$value->titulo_destaque}}
                      </h1>
                    </div>
                    <div data-caption-animate="fadeInUp" data-caption-delay="150" class="offset-top-20 offset-xs-top-40 offset-xl-top-60 inset-lg-center-100">
                      <h5 id="landPageSubTXT" class="text-regular font-default">
                        {{$value->subtitulo}}
                      </h5>
                    </div>
                    <div data-caption-animate="fadeInUp" data-caption-delay="400" class="offset-top-20 offset-xl-top-40">
                      <a href="{{$value->link_botao}}" class="btn btn-primary scrollSuave">
                        {{$value->texto_link}}
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      @endforeach
      <!-- carousel-1 -->


    </div>
    <!-- bolas de troca de página -->
    <div class="swiper-pagination"></div>
    <!-- bolas de troca de página -->
  </div>
</section>

@if(count($sobreadbms) > 0)
<section id="saibaMaisDBM" class="section-70 section-md-114">
  @foreach ($sobreadbms as $sobre)
  <div class="shell">
    <div class="range text-sm-left range-sm-justify">
      <div class="cell-sm-7">
        <!-- video explicativo -->
        <div id="explicaoDBM" class="js-player embed-responsive embed-responsive-16by9">
                <div data-type="youtube" data-video-id="{{$sobre->url_youtube}}"></div>
              </div>
        <!-- video explicativo -->
        <!-- tive que colocar esses js aqui pq ele lá embaixo ele da um conflito com a section que tem o parallax -->
        <!-- Plyr core script -->
        <script src="https://cdn.plyr.io/2.0.12/plyr.js"></script>
        <!-- Docs script -->
        <script src="https://cdn.plyr.io/2.0.12/demo.js"></script>
        <!-- Rangetouch to fix <input type="range"> on touch devices (see https://rangetouch.com) -->
        <script src="https://cdn.rangetouch.com/0.0.9/rangetouch.js" async=""></script>
        <!-- tive que colocar esses js aqui pq ele lá embaixo ele da um conflito com a section que tem o parallax
        não sei pq ele reconhece o parallax como e adiciona elementos que quebram o parallax -->

      </div>
      <div class="cell-sm-5 offset-top-50 offset-sm-top-0">
        <h2 class="text-bold">{{$sobre->titulo}}</h2>
        <hr class="divider bg-madison hr-sm-left-0">
        <div class="offset-top-35 offset-md-top-60">
          <p>{{$sobre->descricao_curta}}</p>
        </div>
        <div class="offset-top-30">
          <a href="{{$sobre->url_externa}}" class="btn btn-icon btn-icon-right btn-default">
            <span class="icon fa-arrow-right"></span><span>Saiba ainda mais</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  @endforeach

</section>
@endif


@if(count( $degustacaos) > 0)
<section id="degustacaoDBM" class="bg-madison section-70 section-md-114 text-center">
  <div class="shell">
    <h2 class="text-bold text-white">Degustação DBM</h2>
    <hr class="divider bg-white">
    <div class="offset-top-35 offset-md-top-60 text-light">Ficou curioso? Assista agora sem custo, algumas de nossas aulas.</div>
    <div class="range range-xs-center offset-top-60 text-sm-left">
      <!-- ao clicar em qualquer video abaixo é chamado um modal para ele cadastrar o email
      ao colocar o email e clicar em enviar ele é redirecionado para a página de cadastro -->
      <!-- estrutura do video desgustação 1 -->
      @foreach($degustacaos as $degustacao)
        <div class="cell-sm-6 cell-md-4">
          <article id="videoDegust-1" class="post-news bg-white">
            <div class="img-wrap-2">
              <span data-toggle="modal" data-target="#registroModal" class="icon mdi mdi-play-circle-outline"></span>
              <!-- essa imagem é alterada via JS -->
              <img src="{{asset('/')}}/{{$degustacao->url_imagem}}" width="370" height="240" alt="" class="img-responsive">
            </div>
            <div class="post-news-body-variant-1">
              <div class="post-news-meta">
                <p class="text-middle text-italic">Grátis</p>
              </div>
              <h6><a href="#" data-toggle="modal" data-target="#registroModal">{{$degustacao->subtitulo}}</a></h6>
              <div class="offset-top-9">
                <p class="text-base"> {{$degustacao->nome}} </p>
              </div>
            </div>
          </article>
        </div>
      @endforeach
      <!-- estrutura do video desgustação 1 -->

    </div>
    <div class="offset-top-35 offset-lg-top-70">
      <!-- leva para sessão de cadastro -->
      <!-- se o usuário cliclar no btn vai para a página de login
      é necessário ter conta para ter acesso -->
      <a href="{{asset('registro#undefined2')}}" class="btn btn-primary">Veja todos as aulas gratuitas</a>
    </div>
  </div>
</section>
<script type="text/javascript">
var recuperaEmail = function(){
  //este valor será passado para a página de cadastro
  var email = $('.degustSubscribe').val();
  document.cookie = "useremail=" + email;
  setCookie('useremail',email,25);
  setTimeout(function(){
    // redireciona para a página de cadastro
    window.location.href = "{{asset('/')}}registro#undefined2";
  }, 1500);

}
</script>
@endif
<!-- modal -->
<!-- registroModal -->
<div id="registroModal" role="dialog" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" class="close mdi mdi-window-close"></button>
      </div>
      <div class="modal-body">
        <div style="background-color:#fff ">
          <!-- criar aqui o model de pedido de registro -->
            <!-- registro apenas de email para prosseguir -->
            <div class="cell-xs-10 cell-md-8 cell-lg-4 text-lg-left offset-top-10 offset-lg-top-40 modalPadding">
              <h6 class="text-bold">Cadastre-se agora no portal DBM</h6>
              <div class="text-subline"></div>
              <div class="offset-top-30 text-left">
                <p>Você terá acesso a todos os vídeos gratuítos. É rápido e fácil!!!</p>
              </div>
              <div class="offset-top-10">
                <form data-form-output="form-subscribe-footer" data-form-type="subscribe" method="post" action="#" class="rd-mailform form-subscribe" name="inscricaoDBM">
                  <div class="form-group">
                    <div class="input-group input-group-sm">
                      <input placeholder="Seu e-mail" type="email" name="email" data-constraints="@Required @Email" class="form-control degustSubscribe">
                      <span class="input-group-btn">
                      <!-- ao clicar no btn o usuário deve ser redirecionado para a acesso.html -->
                      <!-- o value do input deve ser capturado em passado para o input da acesso.html. Desta maneira o usuário continua a fazer o cadastro -->
                      <button type="submit" class="btn btn-sm btn-primary" onclick="recuperaEmail()">Inscrever</button>
                      </span>
                    </div>
                  </div>
                  <div id="form-subscribe-footer" class="form-output"></div>
                </form>
              </div>
            </div>
          <!-- criar aqui o model de pedido de registro -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- registroModal -->
<!-- modal -->
@if(count($dbmnumeros) > 0)

<section id="DBMnumeros" class="text-center">
  <div class="shell">
    <div class="range range-xs-center range-sm-left offset-top-0">
      <div class="cell-xs-10 cell-sm-7 section-image-aside section-image-aside-right">
        <div id="teamDBMfoto" style="background-image: url({{asset('site/images/dbm-team.jpg')}})" class="section-image-aside-img veil reveal-sm-block"></div>
        <div class="section-image-aside-body section-70 section-md-114 inset-md-right-70 inset-lg-right-110">
          <h2 class="text-bold">DBM em números</h2>
          <hr class="divider bg-madison">
          <div class="text-center text-xs-left">
            <div class="range range-xs-center range-md-left offset-top-65 counters">
              <?php $x= 0;?>
              @foreach($dbmnumeros as $dbmnumero)

                @if($x == 0)
                  <div class="cell-xs-6">
                    <div class="unit unit-xs-horizontal unit-responsive-md counter-type-2">
                      <div class="unit-left">
                        <!-- <span class="icon icon-md text-madison mdi mdi-school"></span> -->
                        {!! $dbmnumero->icone !!}
                      </div>
                      <div class="unit-body">
                        <div class="h3 text-bold text-primary">
                          <span data-speed="1300" data-from="0" data-to="{{$dbmnumero->numero}}" class="counter"></span>
                        </div>
                        <div class="offset-top-3">
                          <h6 class="text-black font-accent">{{$dbmnumero->subtitulo}}</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif

                  @if($x == 1)
                  <div class="cell-xs-6 offset-top-65 offset-xs-top-0">
                    <div class="unit unit-xs-horizontal unit-responsive-md counter-type-2">
                      <div class="unit-left">
                        <!-- <span class="icon icon-md text-madison mdi mdi-wallet-travel"></span> -->
                        {!! $dbmnumero->icone !!}
                      </div>
                      <div class="unit-body">
                        <div class="h3 text-bold text-primary">

                          <span data-speed="1250" data-from="0" data-to="{{$dbmnumero->numero}}" class="counter"></span>

                        </div>
                        <div class="offset-top-3">
                          <h6 class="text-black font-accent"> {{$dbmnumero->subtitulo}} </h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif

                  @if($x == 2)
                    <div class="cell-xs-6 offset-top-65">
                      <div class="unit unit-xs-horizontal unit-responsive-md counter-type-2">
                        <div class="unit-left">
                          <!-- <span class="icon icon-md text-madison mdi fa-clock-o"></span> -->
                          {!! $dbmnumero->icone !!}
                        </div>
                        <div class="unit-body">
                          <div class="h3 text-bold text-primary offset-top-5">
                            <span data-step="1500" data-from="0" data-to="{{$dbmnumero->numero}}" class="counter"></span>
                          </div>
                          <div class="offset-top-3">
                            <h6 class="text-black font-accent"> {{$dbmnumero->subtitulo}} </h6>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif

                    @if($x == 3)
                    <div class="cell-xs-6 offset-top-65">
                      <div class="unit unit-xs-horizontal unit-responsive-md counter-type-2">
                        <div class="unit-left">
                          <!-- <span class="icon icon-md text-madison mdi mdi-account-multiple-outline"></span> -->
                          {!! $dbmnumero->icone !!}
                        </div>
                        <div class="unit-body">
                          <div class="h3 text-bold text-primary offset-top-5">
                            <span data-step="500" data-from="0" data-to="{{$dbmnumero->numero}}" class="counter"></span>
                          </div>
                          <div class="offset-top-3">
                            <h6 class="text-black font-accent"> {{$dbmnumero->subtitulo}} </h6>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    <?php $x++;?>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

@if(count($depoimentos) > 0)
<section id="DBMdepoimentos" class="context-dark position-relative">
  <div data-on="false" data-md-on="true" class="rd-parallax">
    <div data-speed="0.2" data-type="media" data-url="{{asset('site/images/depoimentos.jpg')}}" class="rd-parallax-layer"></div>
    <div data-speed="0.05" data-type="html" class="rd-parallax-layer">
      <div class="shell section-70 section-xl-100 section-xl-bottom-114">
        <div data-items="1" data-sm-items="2" data-nav="true" data-dots="true" data-margin="30" data-loop="true" data-nav-class="[&quot;owl-prev fa-angle-left&quot;, &quot;owl-next fa-angle-right&quot;]" class="owl-carousel owl-carousel-default veil-xl-owl-dots veil-owl-nav reveal-xl-owl-nav">
          @foreach($depoimentos as $depoimento)
          <!-- estrutura depoimento -->
          <div id="DBMdepoimentos-1">
            <div class="quote-classic-boxed text-left">
              <div class="quote-body"> <q>{{$depoimento->coment}}</q>
                <div class="offset-top-30 text-left">
                  <div class="unit unit-horizontal">
                    <div class="unit-left"><img src="<?php echo ($depoimento->img_perfil != "")? asset('/').$depoimento->img_perfil : asset('site/images/person_perfil.png'); ?>" width="80" height="80" alt="" class="reveal-inline-block img-circle"></div>
                    <div class="unit-body"> <cite class="font-accent">{{$depoimento->name}}</cite>
                      <div class="offset-top-5">
                        <p class="text-dark text-italic"> {{$depoimento->cidade}} - {{$depoimento->estado}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- estrutura depoimento -->
          @endforeach

        </div>
      </div>
    </div>
  </div>
</section>
@endif
</main>
@endsection
