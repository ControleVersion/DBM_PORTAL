@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">

      <div class="jumbotron text-center">
        <p>Adminsitrar conteúdo da Página inicial (Home)</p>
      </div>
      @if(Session::has('success'))
        <div class="alert-box success">
        <h2>{!! Session::get('success') !!}</h2>
        </div>
      @endif
      <h5>Recursos</h5>
      <div class="card">
        <div class="card-block">

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#one" data-toggle="tab" aria-expanded="false">Banners</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#two" data-toggle="tab" aria-expanded="false">Sobre a DBM</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#three" data-toggle="tab" aria-expanded="true">Degustação DBM</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#four" data-toggle="tab" aria-expanded="true">DBM em números</a>
            </li>


          </ul>

          <div class="tab-content p-a-1 m-b-1"  style="display: inline-block; width: 100%;">
            <div class="tab-pane  active" id="one" aria-expanded="false">

              <button type="button" title="Listar" id="btn-listar" class="btn btn-success btn-circle">
                <i class="material-icons">list</i>
              </button>
              <button type="button" title="Cadastrar Novo" id="btn-cadastrar" class="btn btn-info btn-circle">
                <i class="material-icons">add</i>
              </button>

              <hr>

              <!-- ===== LISTAR ==================== -->
              <div class="card" id="listar-banners">
                <div class="card-header">Banners Cadastrados</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Título</th>
                      <th>Imagem</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x=0;?>
                    @foreach($banners as $banner)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$banner->id}}</th>
                      <td>{{$banner->titulo_destaque}}</td>
                      <td>{{$banner->imagem_destaque}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/banner/edit/')}}/{{$banner->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>

                        <button type="button" onclick="delBanner({{$banner->id}})" class="btn btn-danger btn-sm">
                          <i class="material-icons">clear</i>

                        </button>
                      </td>
                    </tr>
                    <?php $x++?>
                    @endforeach


                  </tbody>
                </table>

                <!-- PAGINACAO DOS BANNERS -->


                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="datatable-example_paginate">
                    <ul class="pagination">
                        <li class="paginate_button {{ ($banners->currentPage() == 1) ? ' disabled' : '' }}">
                            <a href="{{ $banners->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $banners->lastPage(); $i++)
                            <li class="paginate_button {{ ($banners->currentPage() == $i) ? ' active' : '' }}">
                                <a href="{{ $banners->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="paginate_button {{ ($banners->currentPage() == $banners->lastPage()) ? ' disabled' : '' }}">
                            <a href="{{ $banners->url($banners->currentPage()+1) }}" >Próximo</a>
                        </li>
                    </ul>
                  </div>
                </div>

              </div>
              <!-- ===== FIM LISTAR ================ -->

              <!-- ==== CADASTRAR ===== -->
              <div class="col-md-12" id="cadastrar-banners" style="display: none;">
                <div class="card">
                  <div class="card-block">
                    <h5>CADASTRAR BANNER</h5>


                  {!! Form::open(['route'=>'apply.upload','method'=>'post','files'=>true, 'class'=>'form-horizontal']) !!}

                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">Imagem destaque</label>
                        <p class="errors">{!!$errors->first('image')!!}</p>
                          @if(Session::has('error'))
                              <p class="errors">{!! Session::get('error') !!}</p>
                          @endif
                      {!! Form::file('image', ['class'=>'form-control-file', 'id'=>'upload']) !!}
                      <small class="text-help">Imagem no tamanho 1296x546 menor que 500kb.</small>
                    </fieldset>

                    <fieldset class="form-group">
                      <label for="titulo">Titulo Destaque</label>

                      {!! Form::text('titulo_destaque',null, ['class'=>'form-control', 'id'=>'titulo_destaque',  "placeholder"=>"Titulo"]) !!}
                    </fieldset>

                    <fieldset class="form-group">
                      <label for="exampleSelect1">Sub Título</label>

                      {!! Form::text('subtitulo',null, ['class'=>'form-control', 'id'=>'subtitulo',  "placeholder"=>"Subtitulo"]) !!}
                    </fieldset>

                    <fieldset class="form-group">
                      <label for="texto_link">Texto Link</label>

                      {!! Form::text('texto_link',null, ['class'=>'form-control', 'id'=>'texto_link',  "placeholder"=>"Texto Link"]) !!}
                    </fieldset>
                    <fieldset class="form-group">
                      <label for="exampleTextarea">Link do Botão</label>

                      {!! Form::text('link_botao',null, ['class'=>'form-control', 'id'=>'link_botao',  "placeholder"=>"Link botão"]) !!}
                    </fieldset>


                    {!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
              <!--  =========== FIM DOS BANNERS CADASTRADOS ============================ -->
            </div>

            <div class="tab-pane" id="two" aria-expanded="false">
              <!-- =================== INICIO DO BLOCO SOBRE A DBM ==================== -->
              <h5>Sobre a DBM</h5>
              <button type="button" title="Listar" id="btn-listar2" class="btn btn-success btn-circle">
                <i class="material-icons">list</i>
              </button>
              @if($totalSobre == 0)
              <button type="button" title="Cadastrar Novo" id="btn-cadastrar2" class="btn btn-info btn-circle">
                <i class="material-icons">add</i>
              </button>
              @endif

              <hr>
               <!-- ============ CADASTRAR NOVO SOBRE A DBM ===== -->
               <div class="col-md-12" id="cadastrar-sobre" style="display: none;">
                 <div class="card">
                   <div class="card-block">
                     <h5>Cadastrar Novo</h5>
                     @if(Session::has('success'))
                       <div class="alert-box success">
                       <h2>{!! Session::get('success') !!}</h2>
                       </div>
                     @endif

                   {!! Form::open(['route'=>'sobre.store','method'=>'post', 'class'=>'form-horizontal']) !!}

                     <fieldset class="form-group">
                         <label for="Imagem_Destaque">Título</label>

                       {!! Form::text('titulo', null,['class'=>'form-control','required'=>"", 'id'=>'titulo']) !!}

                     </fieldset>

                     <fieldset class="form-group">
                       <label for="titulo">ID Vídeo do Youtube</label>

                       {!! Form::text('url_youtube',null, ['class'=>'form-control', 'required'=>"",'id'=>'url_youtube',  "placeholder"=>"ID YOUTUBE"]) !!}
                     </fieldset>

                     <fieldset class="form-group">
                       <label for="exampleSelect1">Descrição curta</label>

                       {!! Form::text('descricao_curta',null, ['class'=>'form-control', 'required'=>"", 'id'=>'descricao_curta',  "placeholder"=>"Descrição Curta"]) !!}
                     </fieldset>

                     <fieldset class="form-group">
                       <label for="texto_link">Link</label>

                       {!! Form::text('url_externa',null, ['class'=>'form-control', 'id'=>'url_externa',  "placeholder"=>"Link"]) !!}
                     </fieldset>

                     {!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
                     {!! Form::close() !!}
                   </div>
                 </div>
               </div>
               <!-- ============ FIM DO CADASTRAR NOVO SOBRE A DBM ===== -->

               <!-- ============ LISTAR SOBRE A DBM =================== -->

               <div class="card" id="listar-sobre">
                  <div class="card-header">Banners Cadastrados</div>
                   <table class="table">
                     <thead>
                       <tr>
                         <th>#</th>
                         <th>Título</th>
                         <th>Descrição</th>
                         <th>Ação</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php $x=0;?>
                       @foreach($sobreadbms as $sobre)

                       <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                         <th scope="row">{{$sobre->id}}</th>
                         <td>{{$sobre->titulo}}</td>
                         <td>{{$sobre->descricao_curta}}</td>
                         <td>
                           <button onclick="javascript:window.location.href='{{asset('adm/sobre/edit/')}}/{{$sobre->id}}'" type="button" class="btn btn-white btn-sm">
                             <i class="material-icons">edit</i>
                             <span class="icon-text"></span>
                           </button>

                           <button type="button" class="btn btn-danger btn-sm">
                             <i class="material-icons">clear</i>

                           </button>
                         </td>
                       </tr>
                       <?php $x++?>
                       @endforeach


                     </tbody>
                   </table>
               </div>

               <!-- ============ FIM DO LISTAR SOBRE A DBM ============ -->

            </div>

            <div class="tab-pane" id="three" aria-expanded="true">
              <h5>Degustação DBM</h5>

              <button type="button" title="Listar" id="btn-listar3" class="btn btn-success btn-circle">
                <i class="material-icons">list</i>
              </button>
              <button type="button" title="Cadastrar Novo" id="btn-cadastrar3" class="btn btn-info btn-circle">
                <i class="material-icons">add</i>
              </button>

              <hr>

              <!-- ============ LISTAR DEGUSTACAO =================== -->

              <div class="card" id="listar-degustacao">
                 <div class="card-header">Videos Cadastrados</div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Subtítulo</th>
                        <th>Imagem </th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x=0;?>
                      @foreach($degustacaos as $degusta)

                      <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                        <th scope="row">{{$degusta->id}}</th>
                        <td>{{$degusta->subtitulo}}</td>
                        <td>{{$sobre->descricao_curta}}</td>
                        <td>
                          <button onclick="javascript:window.location.href='{{asset('adm/degustacao/edit/')}}/{{$degusta->id}}'" type="button" class="btn btn-white btn-sm">
                            <i class="material-icons">edit</i>
                            <span class="icon-text"></span>
                          </button>

                          <button type="button" onclick="delDegustacao({{$degusta->id}})" class="btn btn-danger btn-sm">
                            <i class="material-icons">clear</i>

                          </button>
                        </td>
                      </tr>
                      <?php $x++?>
                      @endforeach


                    </tbody>
                  </table>
              </div>

              <!-- ============ FIM DO LISTAR DEGUSTACAO ============ -->

              <!-- ============ INICIO DO DEGUSTACAO DBM ========================== -->
              <div  id="cadastrar-degustacao" style="display: none;">
              {!! Form::open(['route'=>'degustacao.store','method'=>'post','files'=>true,'class'=>'form-horizontal']) !!}

                <fieldset class="form-group">
                    <label for="Descricao"> Sub Título </label>

                  {!! Form::text('subtitulo', null,['class'=>'form-control','required'=>"", 'id'=>'subtitulo']) !!}

                </fieldset>

                <fieldset class="form-group">
                    <label for="Descricao"> Descrição Curta </label>

                  {!! Form::text('descricao_curta', null,['class'=>'form-control','required'=>"", 'id'=>'descricao_curta']) !!}

                </fieldset>



                <fieldset class="form-group">
                  <label for="exampleSelect1">Imagem destaque do vídeo</label>
                  <br>
                  <label class="file">

                    {!! Form::file('image',null, ['class'=>'form-control', 'required'=>"", 'id'=>'file']) !!}
                    <span class="file-custom"></span>
                  </label>

                </fieldset>

                <fieldset class="form-group">
                  <label for="texto_link">Link</label>

                  {!! Form::text('link_externo',null, ['class'=>'form-control', 'id'=>'url_externa',  "placeholder"=>"Link"]) !!}
                </fieldset>

                <fieldset class="form-group">
                  <label for="texto_link">Professor</label>
                  <br>
                  <select class="c-select" id="professor_id" name="professor_id">
                      @foreach($professors as $professor)
                      <option value="{{$professor->id}}">{{$professor->nome}}</option>
                      @endforeach
                  </select>
                </fieldset>

                {!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
                {!! Form::close() !!}
              </div>
              <!-- ============ FIM DO DEGUSTACAO DBM ============================= -->
            </div>

            <div class="tab-pane" id="four" aria-expanded="true">
              <h5>DBM em números</h5>
              <button type="button" title="Listar" id="btn-listar4" class="btn btn-success btn-circle">
                <i class="material-icons">list</i>
              </button>
              @if(count($dbmnumeros) < 4)
              <button type="button" title="Cadastrar Novo" id="btn-cadastrar4" class="btn btn-info btn-circle">
                <i class="material-icons">add</i>
              </button>
              @endif
              <hr>
              <!--  ==== INICIO DO DBM EM NUMEROS ==================================== -->
              <div class="card" id="listar-dbmnumeros">
                 <div class="card-header">DBM's Cadastrados</div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Subtítulo</th>
                        <th>Número </th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x=0;?>
                      @foreach($dbmnumeros as $dbmnumero)

                      <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                        <th scope="row">{{$dbmnumero->id}}</th>
                        <td>{{$dbmnumero->subtitulo}}</td>
                        <td>{{$dbmnumero->numero}}</td>
                        <td>
                          <button onclick="javascript:window.location.href='{{asset('adm/dbmnumero/edit/')}}/{{$dbmnumero->id}}'" type="button" class="btn btn-white btn-sm">
                            <i class="material-icons">edit</i>
                            <span class="icon-text"></span>
                          </button>

                          <button type="button" onclick="delDbmnumero({{$dbmnumero->id}})" class="btn btn-danger btn-sm">
                            <i class="material-icons">clear</i>

                          </button>
                        </td>
                      </tr>
                      <?php $x++?>
                      @endforeach


                    </tbody>
                  </table>
              </div>

              <div  id="cadastrar-dbmnumeros" style="display: none;">
              {!! Form::open(['route'=>'dbmnumeros.store','method'=>'post','class'=>'form-horizontal']) !!}

                <fieldset class="form-group">
                    <label for="Descricao"> Ícone representativo </label>

                  {!! Form::text('icone', null,['class'=>'form-control','required'=>"", 'id'=>'icone']) !!}

                </fieldset>

                <fieldset class="form-group">
                  <label for="texto_link">Número</label>

                  {!! Form::number('numero',null, ['class'=>'form-control', 'id'=>'numero',  "placeholder"=>"Número"]) !!}
                </fieldset>

                <fieldset class="form-group">
                    <label for="Descricao"> Subtítulo </label>

                  {!! Form::text('subtitulo', null,['class'=>'form-control','required'=>"", 'id'=>'subtitulo']) !!}

                </fieldset>



                {!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
                {!! Form::close() !!}
              </div>
              <!-- ===== FIM DO DBM EM NUMEROS ======================================= -->

            </div>


        </div>
      </div>

      </div>
  </div>
</div>
<script type="text/javascript">
  setTimeout(function(){
    $('button#btn-cadastrar').click(function(){
      $('#cadastrar-banners').show();
      $('#listar-banners').hide();
    });
    $('button#btn-listar').click(function(){
      $('#cadastrar-banners').hide();
      $('#listar-banners').show();
    });
    //menu Sobre a DBM
    $('button#btn-listar2').click(function(){
      $('#listar-sobre').show();
      $('#cadastrar-sobre').hide();
    });
    $('button#btn-cadastrar2').click(function(){
      $('#listar-sobre').hide();
      $('#cadastrar-sobre').show();
    });
    //menu degustacao
    $('button#btn-listar3').click(function(){
      $('#listar-degustacao').show();
      $('#cadastrar-degustacao').hide();
    });
    $('button#btn-cadastrar3').click(function(){
      $('#listar-degustacao').hide();
      $('#cadastrar-degustacao').show();
    });
    //menu Dbmnumeros
    $('button#btn-cadastrar4').click(function(){
      $('#cadastrar-dbmnumeros').show();
      $('#listar-dbmnumeros').hide();
    });
    $('button#btn-listar4').click(function(){
      $('#cadastrar-dbmnumeros').hide();
      $('#listar-dbmnumeros').show();
    });
    //menu depoimentos
    $('button#btn-cadastrar5').click(function(){
      $('#cadastrar-depoimentos').show();
      $('#listar-depoimentos').hide();
    });
    $('button#btn-listar5').click(function(){
      $('#cadastrar-depoimentos').hide();
      $('#listar-depoimentos').show();
    });
  }, 1500);
</script>
@endsection
