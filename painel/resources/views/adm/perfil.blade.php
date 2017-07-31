@extends('layouts.dashboard')

@section('content')
<!-- PERFIL DO ADMISTRADOR -->
<div class="row">

  @if(Session::has('success'))
    <div class="alert-box success">
    <h2>{!! Session::get('success') !!}</h2>
    </div>
  @endif
        <!-- Column -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Meu Perfil</h5>
            </div>

              <div class="card">
                <div class="card-block">
                  <ul class="nav nav-tabs">

                    <li class="nav-item">
                      <a class="nav-link active" href="#three" data-toggle="tab">
                        <i class="sidebar-menu-icon material-icons">security</i> Mudar Senha
                      </a>
                    </li>
                  </ul>

                  <div class="tab-pane" id="three">

                      <!-- =======  ALTERAR SENHA ======================================= -->
                      <h5 style="padding: 9px; font-size: 16px;"> Alterar Senha de Acesso </h5>

                      <div class="card">
                        <div class="card-block">

                          {!! Form::model($user, [ 'method' => 'PUT', 'class'=>'form-horizontal','name'=>'form_senha','route' => ['users.update', $user->id ]]) !!}
                            <div class="form-group row">
                              <label for="inputNome" class="col-sm-3 form-control-label">Senha</label>
                              <div class="col-sm-9">

                                {!! Form::password('password', null,['pattern'=>'[a-z]{5}','onchange'=>'form_senha.senha_confirmar.pattern = this.value;','class'=>'form-control','value'=>'','required'=>"", 'id'=>'inputpassword']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputConfirmar" class="col-sm-3 form-control-label">Confirmar</label>
                              <div class="col-sm-9">

                                {!! Form::password('senha_confirmar', null,['pattern'=>'[a-z]{5}','class'=>'form-control','value'=>'','required'=>"", 'id'=>'inputConfirmar']) !!}
                              </div>
                            </div>



                            <div class="form-group row m-b-0">
                              <div class="col-sm-offset-3 col-sm-9">

                                 {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary', 'id'=>'bnt-atualizar-user')) !!}
                              </div>
                            </div>
                           {!! Form::close() !!}
                        </div>
                      </div>
                      <!-- ======= FIM DO ALTERAR SENHA ================================= -->
                      <script>
                        setTimeout(function(){
                          $('#bnt-atualizar-user').prop('disabled', true);

                          $('input[name="senha_confirmar"]').focusout(function(){
                            console.log($(this).attr('value'));
                            console.log(document.getElementById('inputpassword') );
                            if(document.getElementById('inputpassword') != document.getElementById('inputConfirmar') ){
                                alert("Senhas devem ser iguais");

                            }else {
                              $('#bnt-atualizar-user').prop('disabled', false);
                            }
                          });
                        }, 1500);


                      </script>
                    </div>

                  </div>
                </div>
              </div>

          </div>
        </div>
        <!-- // END Column -->





        </div>
        <!-- // END column -->

      </div>
@endsection
