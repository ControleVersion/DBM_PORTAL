@extends('layouts.dashboard')

@section('content')

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
              <h5 class="card-title">DADOS DO USUARIO</h5>
            </div>

              <div class="card">
                <div class="card-block">
                  <ul class="nav nav-tabs">

                    <li class="nav-item">
                      <a class="nav-link active" href="#two" data-toggle="tab">
                        <i class="sidebar-menu-icon material-icons">lock</i> Editar Dados
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#three" data-toggle="tab">
                        <i class="sidebar-menu-icon material-icons">security</i> Mudar Senha
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content p-a-1 m-b-1">


                    <div class="tab-pane active" id="two">
                      <h5> Editar </h5>

                      <div class="card">
                        <div class="card-block">

                          {!! Form::model($alunos[0], [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['users.uperfil', $alunos[0]->id ]]) !!}
                            <div class="form-group row">
                              <label for="inputNome" class="col-sm-3 form-control-label">Nome</label>
                              <div class="col-sm-9">
                                <input type="hidden" name="aluno_id" value="{{$alunos[0]->id}}">
                                {!! Form::text('nome', null,['class'=>'form-control','required'=>"", 'id'=>'inputNome', 'placeholder'=>'Nome']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputSobrenome" class="col-sm-3 form-control-label">Sobrenone</label>
                              <div class="col-sm-9">

                                {!! Form::text('sobrenome', null,['class'=>'form-control','required'=>"", 'id'=>'inputSobrenome', 'placeholder'=>'Sobrenome']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-3">Sexo</label>
                              <div class="col-sm-9">

                                  <div class="radio">
                                      <label style="margin-right: 10px;">
                                        <input type="radio" <?php echo ($alunos[0]->sexo == "Masculino")? 'checked="checked"' : '';?> name="sexo" id="optionsRadios1" value="Masculino"> Masculino
                                      </label>
                                      <label>
                                        <input type="radio" <?php echo ($alunos[0]->sexo == "Feminino")? 'checked="checked"' : '';?> name="sexo" id="optionsRadios1" value="Feminino"> Feminino
                                      </label>
                                  </div>

                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputSobrenome" class="col-sm-3 form-control-label">CPF *</label>
                              <div class="col-sm-9">

                                {!! Form::text('cpf', null,['class'=>'form-control','required'=>"",'disabled'=>'disabled', 'id'=>'inputCpf', 'placeholder'=>'CPF']) !!}
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputCEP" class="col-sm-3 form-control-label">CEP</label>
                              <div class="col-sm-9">

                                {!! Form::text('cep', null,['class'=>'form-control','required'=>"", 'id'=>'inputCEP', 'placeholder'=>'CEP']) !!}
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputLogradouro" class="col-sm-3 form-control-label">Logradouro</label>
                              <div class="col-sm-9">

                                {!! Form::text('logradouro', null,['class'=>'form-control','required'=>"", 'id'=>'inputLogradouro', 'placeholder'=>'Logradouro']) !!}

                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputNumero" class="col-sm-3 form-control-label">Número</label>
                              <div class="col-sm-9">

                                {!! Form::number('numero', null,['class'=>'form-control','required'=>"", 'id'=>'inputNumero', 'placeholder'=>'Numero']) !!}

                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputComplemento" class="col-sm-3 form-control-label">Complemento</label>
                              <div class="col-sm-9">

                                {!! Form::text('complemento', null,['class'=>'form-control','id'=>'inputComplemento', 'placeholder'=>'Complemento']) !!}
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputCidade" class="col-sm-3 form-control-label">Cidade</label>
                              <div class="col-sm-9">

                                {!! Form::text('cidade', null,['class'=>'form-control','required'=>"", 'id'=>'inputCidade', 'placeholder'=>'Cidade']) !!}
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputBairro" class="col-sm-3 form-control-label">Bairro</label>
                              <div class="col-sm-9">

                                {!! Form::text('bairro', null,['class'=>'form-control','required'=>"", 'id'=>'inputBairro', 'placeholder'=>'Bairro']) !!}
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEstado" class="col-sm-3 form-control-label">Estado</label>
                              <div class="col-sm-9">

                                {!! Form::text('estado', null,['class'=>'form-control','required'=>"", 'id'=>'inputEstado', 'placeholder'=>'Estado']) !!}
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="inputEstado" class="col-sm-3 form-control-label">Status</label>
                              <div class="col-sm-9">

                                <select class="form-control" name="status">
                                    <option value="{{$alunos[0]->status}}"> {{$alunos[0]->status}}  </option>
                                    <option value="Inativo"> Inativo  </option>
                                    <option value="Ativo"> Ativo  </option>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row m-b-0">
                              <div class="col-sm-offset-3 col-sm-9">

                                 {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
                              </div>
                            </div>
                           {!! Form::close() !!}
                        </div>
                      </div>

                    </div>

                    <div class="tab-pane" id="three">

                      <!-- =======  ALTERAR SENHA ======================================= -->
                      <h5> Alterar Senha de Acesso </h5>

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

        <!-- Column -->
        <div class="col-md-4">

          <!-- Summary -->
          <div class="card">
            <div class="card-header bg-white">
              <h5 class="card-title">Recursos</h5>
            </div>
            <div class="list-group list-group-sm list-group-fit">
              <div class="list-group-item">
                <span class="text-primary pull-xs-right strong">{{$alunos[0]->plano_acesso}}</span> Tipo de Plano
              </div>

            </div>
          </div>
          <!-- // END Summary -->



        </div>
        <!-- // END column -->

      </div>
@endsection
