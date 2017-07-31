@extends('layouts.site.site')

@section('content')
<main>
  <section class="bg-madison section-70 section-md-20 text-center"s>
    <div class="shell">
      <h2 id="mainTitleDBM" class="text-bold text-white">DBMicos pelo Brasil</h2>
      <hr class="divider bg-white">
      <div class="range range-xs-center offset-top-20 text-sm-left">

        <!-- colocar o mapa aqui -->
        <div class="cell-md-5 cell-lg-5">
          <p class="text-light">Selecione um estado para conhecer os DBMicos</p>

            <!-- apenas para o mobile -->
            <!-- facilita clique -->
            <div class="hidden-md hidden-lg">
              <select id="form-register-estado" name="estado" class="form-control bg-white">
                  <option value="0">Selecione o estado</option>
                  <option value="ac">Acre</option>
                  <option value="al">Alagoas</option>
                  <option value="ap">Amapá</option>
                  <option value="am">Amazonas</option>
                  <option value="ba">Bahia</option>
                  <option value="ce">Ceará</option>
                  <option value="df">Distrito Federal</option>
                  <option value="es">Espírito Santo</option>
                  <option value="go">Goiás</option>
                  <option value="ma">Maranhão</option>
                  <option value="mt">Mato Grosso</option>
                  <option value="ms">Mato Grosso do Sul</option>
                  <option value="mg">Minas Gerais</option>
                  <option value="pa">Pará</option>
                  <option value="pb">Paraíba</option>
                  <option value="pr">Paraná</option>
                  <option value="pe">Pernambuco</option>
                  <option value="pi">Piauí</option>
                  <option value="rj">Rio de Janeiro</option>
                  <option value="rn">Rio Grande do Norte</option>
                  <option value="rs">Rio Grande do Sul</option>
                  <option value="ro">Rondônia</option>
                  <option value="rr">Roraima</option>
                  <option value="sc">Santa Catarina</option>
                  <option value="sp">São Paulo</option>
                  <option value="se">Sergipe</option>
                  <option value="to">Tocantins</option>
              </select>
            </div>

          <div id="vmap"></div>
        </div>
        <!-- colocar o mapa aqui -->


        <!-- inicio lista dbmicos -->
        <div class="cell-md-7 cell-lg-7 hidden-xs" style="color:#fff">
          <!-- recebe o valor da cidade que do hover -->
          <span id="DBMmodalFakeClick" data-toggle="modal" data-target="#dbmicosModal"></span>
          <span class="text-light dbmicos-localidade">Escolha uma estado</span>

            <ul class="lista-dbmicos-brasil list-unstyled ">
            <!-- estrutura aluno -->
            <li class="lista-dbmicos-brasil-item">
              <div class="text-left unit unit-horizontal txt-branco">
                <div class="unit-left">
                  <img src="{{asset('/')}}/site/images/80x80.jpg" width="60" height="60" alt="" class="img-responsive reveal-inline-block img-circle">
                </div>
                <div class="lista-dbmicos-info">
                  <cite class="font-accent lista-dbmicos-info-nome">Dra. Carla Souza</cite>
                  <div class="offset-top-5">
                    <p class="text-italic">
                      <span class="lista-dbmicos-info-profissao">Nutricionista</span><span>, </span>
                      <span class="lista-dbmicos-info-cidade">São Paulo</span>
                      <span>- </span>
                      <span class="lista-dbmicos-info-estado">SP</span>
                    </p>
                  </div>
                  <div class="offset-top-10 offset-sm-top-10">
                    <ul class="list-inline list-inline-xs list-inline-madison">
                      <li>
                        <a href="#" class="lista-dbmicos-info-fb icon icon-xxs fa-facebook icon-circle icon-gray-light-filled"></a>
                      </li>
                      <li>
                        <a href="#" class="lista-dbmicos-info-inst lista-dbmicos-info-gp icon icon-xxs fa-instagram icon-circle icon-gray-light-filled"></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <!-- estrutura aluno -->
            <!-- estrutura aluno -->
           <li class="lista-dbmicos-brasil-item">
              <div class="text-left unit unit-horizontal txt-branco">
                <div class="unit-left">
                  <img src="{{asset('/')}}/site/images/80x80.jpg" width="60" height="60" alt="" class="img-responsive reveal-inline-block img-circle">
                </div>
                <div class="lista-dbmicos-info">
                  <cite class="font-accent lista-dbmicos-info-nome">Dra. Carla Souza</cite>
                  <div class="offset-top-5">
                    <p class="text-italic">
                      <span class="lista-dbmicos-info-profissao">Nutricionista</span><span>, </span>
                      <span class="lista-dbmicos-info-cidade">São Paulo</span>
                      <span>- </span>
                      <span class="lista-dbmicos-info-estado">SP</span>
                    </p>
                  </div>
                  <div class="offset-top-10 offset-sm-top-10">
                    <ul class="list-inline list-inline-xs list-inline-madison">
                      <li>
                        <a href="#" class="lista-dbmicos-info-fb icon icon-xxs fa-facebook icon-circle icon-gray-light-filled"></a>
                      </li>
                      <li>
                        <a href="#" class="lista-dbmicos-info-inst lista-dbmicos-info-gp icon icon-xxs fa-instagram icon-circle icon-gray-light-filled"></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <!-- estrutura aluno -->
            <!-- estrutura aluno -->

          </ul>
          <!-- final lista dbmicos -->

        </div>
      </div>
    </div>
    <!-- modal -->
          <!-- dbmicosModal -->
          <!-- chamar o modal apenas na versão mobile  -->
          <div id="dbmicosModal" role="dialog" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" data-dismiss="modal" class="close mdi mdi-window-close"></button>
                </div>
                <div class="modal-body" >
                  <div style="background-color:#fff;overflow:auto; max-height:500px; padding-bottom:20px;">
                    <!-- criar aqui o model de pedido de registro -->
                      <!-- registro apenas de email para prosseguir -->
                      <div class="cell-xs-10 cell-md-10 cell-lg-10 text-lg-left offset-top-10 offset-lg-top-40">
                        <h6 class="text-bold dbmicos-localidade">Estado</h6>
                        <div class="text-subline"></div>
                          <span id="modal-mark"></span>
                          <ul class="lista-dbmicos-brasil list-unstyled offset-top-10">

                            <!-- estrutura aluno -->
                            <li class="lista-dbmicos-brasil-item">
                              <div class="text-left unit unit-horizontal txt-branco">
                                <div class="unit-left">
                                  <img src="{{asset('/')}}/site/images/80x80.jpg" width="60" height="60" alt="" class="img-responsive reveal-inline-block img-circle">
                                </div>
                                <div class="lista-dbmicos-info lista-dbmicos-info-modal">
                                  <cite class="font-accent lista-dbmicos-info-nome">Dra. Carla Souza</cite>
                                  <div class="offset-top-5">
                                    <p class="text-italic">
                                      <span class="lista-dbmicos-info-profissao">Nutricionista</span><span>, </span>
                                      <span class="lista-dbmicos-info-cidade">São Paulo</span>
                                      <span>- </span>
                                      <span class="lista-dbmicos-info-estado">SP</span>
                                    </p>
                                  </div>
                                  <div class="offset-top-10 offset-sm-top-10">
                                    <ul class="list-inline list-inline-xs list-inline-madison">
                                      <li>
                                        <a href="#" class="lista-dbmicos-info-fb icon icon-xxs fa-facebook icon-circle icon-gray-light-filled"></a>
                                      </li>
                                      <li>
                                        <a href="#" class="lista-dbmicos-info-inst lista-dbmicos-info-gp icon icon-xxs fa-instagram icon-circle icon-gray-light-filled"></a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>

                      </div>
                    <!-- criar aqui o model de pedido de registro -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- registroModal -->
          <!-- modal -->

          <!-- mapa -->
          <!--  CONDICAO CRIADA NO TEMPLATE site.blade.php
            <script type="text/javascript" src="{{asset('site')}}/js/jquery.vmap.js"></script>
            <script type="text/javascript" src="{{asset('site')}}/js/jquery.vmap.brazil.js" charset="utf-8"></script>
            <script type="text/javascript" src="{{asset('site')}}/js/br-map.js"></script>
          -->
    </section>
  </main>

<script type="text/javascript">
  	setTimeout(function(){
  		ativarMenu("dbmicos");
  	}, 1500);

</script>

@endsection
