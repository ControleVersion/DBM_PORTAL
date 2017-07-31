@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



      <div class="jumbotron text-center">
        <p>Adminsitrar Configurações</p>
      </div>
      @if(Session::has('success'))
        <div class="alert-box success">
        <h3>{!! Session::get('success') !!}</h3>
        </div>
      @endif

      <div class="card">
        <div class="card-block">

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#one" data-toggle="tab" aria-expanded="false">Pagseguro</a>
            </li>


          </ul>

          <div class="tab-content p-a-1 m-b-1"  style="display: inline-block; width: 100%;">
            <div class="tab-pane  active" id="one" aria-expanded="false">

              <button type="button" title="Cadastrar Novo" id="btn-listar" class="btn btn-success btn-circle">
                <i class="material-icons">list</i>
              </button>
              <!--
              <button type="button" title="Cadastrar Novo" id="btn-cadastrar" class="btn btn-info btn-circle">
                <i class="material-icons">add</i>
              </button>
              -->

              <hr>

              <!-- ===== LISTAR ==================== -->
              <div class="card" id="listar-banners">
                <div class="card-header">Conteúdos Cadastrados</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>TOKEN</th>
                      <th>EMAIL</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php  $x=0;  ?>
                    @foreach($configuracoes as $configurar)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$configurar->id}}</th>
                      <td>{{$configurar->pagseguro_token}}</td>
                      <td>{{$configurar->pagseguro_email}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/configuracoes/edit/')}}/{{$configurar->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>
                      </td>
                    </tr>
                    <?php $x++;  ?>
                    @endforeach

                  </tbody>
                </table>




              </div>
              <!-- ===== FIM LISTAR ================ -->


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
