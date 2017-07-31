@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



      <div class="jumbotron text-center">
        <p>Adminsitrar conteúdo da Página Dbmcurso</p>
      </div>
      @if(Session::has('success'))
        <div class="alert-box success">
        <h2>{!! Session::get('success') !!}</h2>
        </div>
      @endif
      <h5>Lista de conteúdo</h5>
      <div class="card">
        <div class="card-block">

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#one" data-toggle="tab" aria-expanded="false">Cursos</a>
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
                <div class="card-header">Conteúdos Cadastrados</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Titulo</th>
                      <th>Data</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $x=0;  ?>
                    @foreach($dbmcursos as $curso)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$curso->id}}</th>
                      <td>{{$curso->titulo}}</td>
                      <td>{{$curso->created_at}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/dbmcurso/edit/')}}/{{$curso->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>

                        <button type="button" onclick="delDbmcurso({{$curso->id}})" class="btn btn-danger btn-sm">
                          <i class="material-icons">clear</i>

                        </button>
                      </td>
                    </tr>
                    <?php $x++;  ?>
                    @endforeach

                  </tbody>
                </table>




              </div>
              <!-- ===== FIM LISTAR ================ -->

              <!-- ==== CADASTRAR ===== -->
              <div class="col-md-12" id="cadastrar-banners" style="display: none;">
                <div class="card">
                  <div class="card-block">
                    <h5>CADASTRAR NOVO</h5>


                  {!! Form::open(['route'=>'dbmcursos.store','method'=>'post', 'class'=>'form-horizontal']) !!}

                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">ID do Vídeo Youtube</label>


                      <input type="text" value="" maxlength="50"  name="video_id" class="form-control" >
                      <small class="text-help">Insira somente o ID do vídeo do Youtube.</small>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="Nome">Título</label>


                      <input type="text" value="" maxlength="50"  name="titulo" class="form-control" >

                    </fieldset>

                    <fieldset class="form-group">
                      <label for="titulo"> Descrição curta </label>


                      <textarea name="descricao" col="8" maxlength="200" class="form-control"></textarea>
                      <small class="text-help"> Limite de 200 caracteres.</small>
                    </fieldset>



                    {!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
              <!--  =========== FIM DOS dbmcurso CADASTRADOS ============================ -->
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
