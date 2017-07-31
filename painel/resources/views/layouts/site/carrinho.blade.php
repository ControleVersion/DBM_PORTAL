 @extends('layouts.site.site')

@section('content')

<link rel="stylesheet" href="{{asset('site/css/css-stars.css')}}">

<style type="text/css">
.top-margin-review{
    margin-top: 10px;
}
</style>

<main class="page-content section-70 section-md-114">

    <section>
      @foreach($videoaula as $video)
       <form method="post" id="reg-form" accept-charset="UTF-8" action="{{asset('return-pagamento')}}">
          <div class="shell">
            <div class="range range-xs-center">
              <div class="cell-sm-6 text-lg-left">
                <div data-arrows="false" data-loop="false" data-dots="false" data-swipe="false" data-items="1" data-child="#child-carousel" data-for="#child-carousel" class="slick-slider carousel-parent">
                  <div class="item">

                    <img src="{{asset('/')}}/{{$video->miniatura}}"  alt=""  class="img-responsive reveal-inline-block" />

                  </div>
                </div>
              </div>
              <div class="cell-sm-6 text-sm-left offset-top-60 offset-sm-top-0">
                <h4 class="text-bold">{{$video->tema}}</h4>
                <hr class="divider bg-madison hr-sm-left-0">
                <div class="offset-top-60">
                  <ul class="list-inline rating reveal-inline-block">
                    <li class="icon fa-star"></li>
                    <li class="icon fa-star"></li>
                    <li class="icon fa-star"></li>
                    <li class="icon fa-star"></li>
                    <li class="icon fa-star"></li>
                  </ul>
                  <a href="#descricao" class="inset-left-30 scrollSuave">1 review</a> </div>

                  <p>{{$video->resumo}}</p>

                <div class="offset-top-30">
                  <h4><span>R$ </span> {{$video->valor}} <span class="text-gray text-strike inset-left-10">R$ {{$video->valor_bruto}}</span></h4>
                </div>

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- dados da compra -->
                      <input type="hidden" name="paymentMethod" value="boleto">
                      <input type="hidden" name="currency" value="BRL">
                      <!--
                      <input type="text" name="extraAmount" value="1.00">
                    -->
                      <input type="hidden" name="itemId1" value="00{{$video->id}}">
                      <input type="hidden" name="itemDescription1" value="{{$video->tema}}">
                      <input type="hidden" name="itemQuantity1" value="1">
                      <input type="hidden" name="shippingType" value="1">
                      <input type="hidden" name="curso_id" value="{{$video->video_id}}">

                <div class="offset-top-20">
                  <button type="submit" id="sender" class="btn btn-primary btn-icon btn-icon-left">
                    <span class="icon fa-shopping-cart"></span>
                    <span>Comprar</span>
                  </button>

                </div>
              </div>
            </div>
          </div>

        </form>
      @endforeach
    </section>

    <span id="descricao"></span>
    <section  class="offset-top-85" style="padding-bottom:40px;">
      <div class="shell">
        <div class="range range-xs-center">
          <div class="cell-xs-10 cell-lg-12">
            <div data-type="vertical" class="responsive-tabs responsive-tabs-classic vertical">
              <ul data-group="tabs-group-default" class="resp-tabs-list tabs-1 text-center tabs-group-default">

                <li>Mais Informações</li>
                <li>Reviews <span>({{count($reviews)}})</span></li>
              </ul>
              <div data-group="tabs-group-default" class="resp-tabs-container text-sm-left tabs-group-default">

                <div>
                  <div class="inset-lg-left-30">
                    <table class="table table-custom table-fixed table-hover-rows table-product">
                      <tbody>
                        <tr>
                          <td><strong>intem</strong></td>
                          <td><strong>quantidade</strong></td>
                        </tr>
                        <tr>
                          <td>Duração</td>
                          <td>{{$video->duracao}}</td>
                        </tr>
                        <tr>
                          <td>Material didático</td>
                          <td>
                              @foreach($videoaula as $video)
                                @if($video->material_01 != ""  || $video->material_02 != "")
                                  incluso
                                @else
                                  não incluso
                                @endif
                              @endforeach

                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
                <div>
                  <div class="inset-lg-left-30">
                    <div class="box-comment text-left box-comment-classic">
                      <!-- review estrutura básica -->
                      @foreach($reviews as $review)
                      	@if($review->status == 'Ativo')
                      <div class="unit unit-xs-horizontal top-margin-review">
                        <div class="unit-left"><img src="{{($review->img_perfil != '')? asset('/').$review->img_perfil : asset('/').'site/images/80x80.jpg'}}" alt="" width="80" height="80" class="img-rounded box-comment-img"/></div>
                        <div class="unit-body">
                          <div>
                            <p class="box-comment-title">
                              <span class="h6 text-primary text-bold">{{$review->name}}</span>
                              <ul class="list-inline rating reveal-inline-block">
                                @for($x=0; $x < $review->review; $x++)
                                <li class="icon fa-star"></li>
                                @endfor
                                @if($review->review == 4)
                                  <li class="icon fa-star" style="color:silver"></li>
                                @endif
                                @if($review->review == 3)
                                  <li class="icon fa-star" style="color:silver"></li>
                                  <li class="icon fa-star" style="color:silver"></li>
                                @endif
                                @if($review->review == 2)
                                  <li class="icon fa-star" style="color:silver"></li>
                                  <li class="icon fa-star" style="color:silver"></li>
                                  <li class="icon fa-star" style="color:silver"></li>
                                @endif
                                @if($review->review == 1)
                                  <li class="icon fa-star" style="color:silver"></li>
                                  <li class="icon fa-star" style="color:silver"></li>
                                  <li class="icon fa-star" style="color:silver"></li>
                                  <li class="icon fa-star" style="color:silver"></li>
                                @endif

                              </ul>
                            </p>
                          </div>

                        </div>
                        @endif
                      </div>
                      @endforeach
                      <div class="clear-fix"></div>
                      <hr>
                      <div class="box-comment-body offset-top-10">
                        <p>O que achou do curso?</p>

                        <!--  ============ -->
                        <div class="stars stars-example-css">
                          <div class="br-wrapper br-theme-css-stars">
                              <select id="example-css" name="rating" autocomplete="off" style="display: none;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                              {{ csrf_field() }}
                          </div>
                          <br>
                            <textarea name="comment"  class="form-control" id="comment"></textarea>
                          <br>
                          <span class="title">Faça sua avaliação</span>
                            <p>
                                <button id="env-avaliar" class="btn btn-success btn-sm"> AVALIAR</button>
                            </p>
                            <p id="mensagem-avaliar">

                            </p>
                        </div>
                        <!-- ============= -->
                      </div>
                      <!-- review estrutura básica -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</main>

<script type="text/javascript">
  setTimeout(function(){
    $('.select2-container--bootstrap').hide();

    $('#env-avaliar').click(function(){
        var valor = $('select[name="rating"]').val();
        var comment = $('textarea[name="comment"]').val();
        var videoID = $('input[name="curso_id"]').val();
        var _token = $('input[name="_token"]').val();
        $(this).prop('disabled', true);
        $.ajax({
          url: "{{asset('register-review/')}}/"+valor,
          type: "post",
          dataType: "json",
          data: {valor: valor, comment: comment, video_id: videoID,_token : _token},
          success: function(dados){
            console.log(dados.return);
            if(dados.return == "FAIL_LOGIN"){
              $('#mensagem-avaliar').html('<div class="alert alert-danger">  <strong>Atenção!</strong> Você precisa ser registrado para avaliar.<br><a href="{{asset('registro#undefined2')}}">Clique aqui e registre-se</a></div>');
            }
            if(dados.return == "REPEAT"){
              $('#mensagem-avaliar').html('<div class="alert alert-warning"> <strong>Atenção!</strong> Você já avaliou este curso.</div>');
            }
            if(dados.return == "OK"){
              $('#mensagem-avaliar').html('<div class="alert alert-success"> <strong>Parabéns!</strong> Agradecemos o seu retorno e avaliação de nosso curso.</div>');
            }
          }
        });
        //console.log(valor);
    });
  },1500);
</script>

@endsection
