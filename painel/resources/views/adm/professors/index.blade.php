@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



      <div class="jumbotron text-center">
        <p>Adminsitrar Professores</p>
      </div>
      @if(Session::has('success'))
        <div class="alert-box success">
        <h3>{!! Session::get('success') !!}</h3>
        </div>
      @endif
      <h5>Lista de Professores</h5>
      <div class="card">
        <div class="card-block">

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#one" data-toggle="tab" aria-expanded="false">Professores</a>
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
                      <th>Nome</th>
                      <th>Especialidade</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php  $x=0;  ?>
                    @foreach($professores as $professor)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$professor->id}}</th>
                      <td>{{$professor->nome}}</td>
                      <td>{{$professor->especialidade}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/professors/edit/')}}/{{$professor->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>

                        <button type="button" onclick="delProfessor({{$professor->id}})" class="btn btn-danger btn-sm">
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
                    <h5>Cadastrar Professor</h5>


                  {!! Form::open(['route'=>'professors.store','files'=>true, 'method'=>'post', 'class'=>'form-horizontal']) !!}

                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">Nome</label>
                        <input type="text" value="" maxlength="70"  name="nome" class="form-control" required>
                        <small class="text-help"> No máximo 80 caracteres.</small>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">Especialidade</label>
                        <input type="text"  value="" maxlength="100"  name="especialidade" class="form-control" required>
                    </fieldset>

                    
                    <fieldset class="form-group">
                        <label for="Resumo">Foto Perfil</label>

                        {!! Form::file('foto_perfil', null,['class'=>'form-control',"maxlength"=>"200",'required'=>"", 'id'=>'foto_perfil']) !!}
                        <small class="text-help"> Arquivo de imagem nos formatos .PNG, .JPG ou JPEG de no máximo 100x100 pixels e menor que 100k.</small>
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
