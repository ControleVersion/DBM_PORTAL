@extends('layouts.dashboard')

@section('content')


<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid  kv-main"> 



      <div class="jumbotron text-center">
        <p>Adminsitrar conteúdo da Página de Galerias</p>
      </div>
      @if(Session::has('success'))
        <div class="alert-box success">
        <h2>{!! Session::get('success') !!}</h2>
        </div>
      @endif 
      <h5>Recursos da Galeria</h5>
      <div class="card">
        <div class="card-block">

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#one" data-toggle="tab" aria-expanded="false">Galerias</a>
            </li>
            
            
          </ul>

          <div class="tab-content p-a-1 m-b-1"  style="display: inline-block; width: 100%;">
            <div class="tab-pane  active" id="one" aria-expanded="false">

              <button type="button" title="Cadastrar Novo" id="btn-listar" class="btn btn-success btn-circle">
                <i class="material-icons">list</i>
              </button>
              <button type="button" title="Cadastrar Novo" id="btn-cadastrar" class="btn btn-info btn-circle">
                <i class="material-icons">add</i>
              </button>

              <hr>

              <!-- ===== LISTAR ==================== -->
              <div class="card" id="listar-banners">
                <div class="card-header">Galerias Cadastradas</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Título</th>
                      <th>Data</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php $x=0;?>
                    @foreach($galerias as $galeria)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$galeria->id}}</th>
                      <td>{{$galeria->titulo}}</td>
                      <td>{{$galeria->created_at}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/galerias/edit/')}}/{{$galeria->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>

                        <button type="button" onclick="delGaleria({{$galeria->id}})" class="btn btn-danger btn-sm">
                          <i class="material-icons">clear</i>

                        </button>
                      </td>
                    </tr>
                    <?php $x++?>
                    @endforeach

                  </tbody>
                </table>

                <!-- PAGINACAO DAS GALERIAS -->


                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="datatable-example_paginate">
                    <ul class="pagination">
                        <li class="paginate_button {{ ($galerias->currentPage() == 1) ? ' disabled' : '' }}">
                            <a href="{{ $galerias->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $galerias->lastPage(); $i++)
                            <li class="paginate_button {{ ($galerias->currentPage() == $i) ? ' active' : '' }}">
                                <a href="{{ $galerias->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="paginate_button {{ ($galerias->currentPage() == $galerias->lastPage()) ? ' disabled' : '' }}">
                            <a href="{{ $galerias->url($galerias->currentPage()+1) }}" >Próximo</a>
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
                    <h5>CADASTRAR IMAGEM DE GALERIA</h5>


                  {!! Form::open(['route'=>'galerias.store','method'=>'post','files'=>true, 'class'=>'form-horizontal']) !!}

                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">Imagem miniatura</label>
                        <p class="errors">{!!$errors->first('image')!!}</p>
                          @if(Session::has('error'))
                              <p class="errors">{!! Session::get('error') !!}</p>
                          @endif
                      {!! Form::file('image', ['class'=>'form-control-file', 'id'=>'upload']) !!}
                      <small class="text-help">Imagem no tamanho 370x370 menor que 250kb.</small>
                    </fieldset>

                    
                    <fieldset class="form-group">
                      <label for="titulo">Titulo Destaque</label>

                      {!! Form::text('titulo',null, ['class'=>'form-control', 'id'=>'titulo',  "placeholder"=>"Titulo"]) !!}
                    </fieldset>

                    <fieldset class="form-group">
                      <label for="exampleSelect1">Descrição Curta</label>

                      {!! Form::textarea('descricao_curta',null, ['class'=>'form-control', 'id'=>'descricao_curta']) !!}
                    </fieldset>

                    


                    {!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
              <!--  =========== FIM DOS BANNERS CADASTRADOS ============================ -->
            </div>

                                               

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
   
  	 
  
  }, 1500);
</script>
@endsection
