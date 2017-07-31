@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



      <div class="jumbotron text-center">
        <p>Adminsitrar conteúdo da Página de Profissionais</p>
      </div>
      @if(Session::has('success'))
        <div class="alert-box success">
        <h2>{!! Session::get('success') !!}</h2>
        </div>
      @endif
      <h5>Lista de Profissionais</h5>
      <div class="card">
        <div class="card-block">

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#one" data-toggle="tab" aria-expanded="false">Profissionais</a>
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
                <div class="card-header">Profissionais Cadastradas</div>
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

                    <?php $x=0;  ?>
                    @foreach($profissionais as $profissional)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$profissional->id}}</th>
                      <td>{{$profissional->nome}}</td>
                      <td>{{$profissional->created_at}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/profissionais/edit/')}}/{{$profissional->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>

                        <button type="button" onclick="delProfissional({{$profissional->id}})" class="btn btn-danger btn-sm">
                          <i class="material-icons">clear</i>

                        </button>
                      </td>
                    </tr>
                    <?php $x++;  ?>
                    @endforeach

                  </tbody>
                </table>

                <!-- PAGINACAO DAS GALERIAS -->







              </div>
              <!-- ===== FIM LISTAR ================ -->

              <!-- ==== CADASTRAR ===== -->
              <div class="col-md-12" id="cadastrar-banners" style="display: none;">
                <div class="card">
                  <div class="card-block">
                    <h5>CADASTRAR NOVO PROFISSIONAL</h5>


                  {!! Form::open(['route'=>'profissionais.store','method'=>'post','files'=>true, 'class'=>'form-horizontal']) !!}

                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">Foto perfil</label>
                        <p class="errors">{!!$errors->first('image')!!}</p>
                          @if(Session::has('error'))
                              <p class="errors">{!! Session::get('error') !!}</p>
                          @endif
                      {!! Form::file('image', ['class'=>'form-control-file', 'id'=>'upload']) !!}
                      <small class="text-help">Imagem no tamanho 340x340 menor que 150kb.</small>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="Nome">Nome</label>


                      <input type="text" value="" name="nome" class="form-control" >

                    </fieldset>

                    <fieldset class="form-group">
                      <label for="titulo"> Formação / Atuação </label>

                      <input type="text" value="" name="formacao" class="form-control" >
                    </fieldset>

                    <fieldset class="form-group">
                      <label for="exampleSelect1">Descrição Curta</label>


                      <textarea type="textarea" col="8" name="instagram" class="form-control" ></textarea>
                    </fieldset>

                    <fieldset class="form-group">
                      <label for="Facebook"> Facebook URL </label>


                      <input type="text" value="" name="facebook" class="form-control" >
                    </fieldset>

                    <fieldset class="form-group">
                      <label for="Instagram"> Instagram URL </label>

                      <input type="text" value="" name="instagram" class="form-control" >
                    </fieldset>

                    {!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
              <!--  =========== FIM DOS PROFISSIONAIS CADASTRADOS ============================ -->
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
