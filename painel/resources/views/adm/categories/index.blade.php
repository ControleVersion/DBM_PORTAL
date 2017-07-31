@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



      <div class="jumbotron text-center">
        <p>Adminsitrar Categorias</p>
      </div>
      @if(Session::has('success'))
        <div class="alert-box success">
        <h2>{!! Session::get('success') !!}</h2>
        </div>
      @endif
      <h5>Lista de Categorias</h5>
      <div class="card">
        <div class="card-block">

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#one" data-toggle="tab" aria-expanded="false">Categorias</a>
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
                      <th>Data</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php  $x=0;  ?>
                    @foreach($categories as $category)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$category->id}}</th>
                      <td>{{$category->nome}}</td>
                      <td>{{$category->created_at}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/categories/edit/')}}/{{$category->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>

                        <button type="button" onclick="delCategory({{$category->id}})" class="btn btn-danger btn-sm">
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
                    <h5>CADASTRAR NOVA CATEGORIA</h5>


                  {!! Form::open(['route'=>'categories.store','method'=>'post', 'class'=>'form-horizontal']) !!}

                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">Nome</label>


                      <input type="text" value="" maxlength="70"  name="nome" class="form-control" >
                      <small class="text-help"> No máximo 80 caracteres.</small>
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
