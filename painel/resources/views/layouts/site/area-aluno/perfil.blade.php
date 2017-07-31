@extends('layouts.site.area-aluno.default')

@section('content')
<style type="text/css">
.row > .column {
padding: 0 8px;
}

.row:after {
content: "";
display: table;
clear: both;
}

.column {
float: left;
width: 25%;
}

/* The Modal (background) */
.modal {
display: none;
position: fixed;
z-index: 1;
padding-top: 100px;
left: 0;
top: 0;
width: 100%;
height: 100%;
overflow: auto;
background-color: rgba(0, 0, 0, 0.72);
}

/* Modal Content */
.modal-content {
position: relative;
background-color: #fefefe;
margin: auto;
padding: 20;
width: 90%;
height: 450px;
max-width: 1200px;
}

/* The Close Button */
.close {
color: white;
position: absolute;
top: 10px;
right: 25px;
font-size: 35px;
font-weight: bold;

}

.close:hover,
.close:focus {
color: #999;
text-decoration: none;
cursor: pointer;
}

.mySlides {
display: none;
}

.cursor {
cursor: pointer
}

/* Next & previous buttons */
.prev,
.next {
cursor: pointer;
position: absolute;
top: 50%;
width: auto;
padding: 16px;
margin-top: -50px;
color: white;
font-weight: bold;
font-size: 20px;
transition: 0.6s ease;
border-radius: 0 3px 3px 0;
user-select: none;
-webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
right: 0;
border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
color: #f2f2f2;
font-size: 12px;
padding: 8px 12px;
position: absolute;
top: 0;
}

img {
margin-bottom: -4px;
}

.caption-container {
text-align: center;
background-color: black;
padding: 2px 16px;
color: white;
}

.demo {
opacity: 0.6;
}

.active,
.demo:hover {
opacity: 1;
}

img.hover-shadow {
transition: 0.3s
}

.hover-shadow:hover {
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}
</style>
<div class="row">

  @if(Session::has('success'))
    <div class="alert-box success">
    <h2>{!! Session::get('success') !!}</h2>
    </div>
  @endif
  
  @if(Auth::user()->id == $alunos[0]->user_id)
        <!-- Column -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title" id="meu-perfil">Meu Perfil</h5>
            </div>

              <div class="card">
                <div class="card-block">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#one" data-toggle="tab">
                        <i class="sidebar-menu-icon material-icons">person_outline</i> Perfil
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#two" data-toggle="tab">
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
                    <div class="tab-pane active" id="one">
                      <!--  ===== DADOS DO PERFIL DE ALUNO ==================================================== -->
                      <table class="table table-striped table-sm m-b-0">

                          <tbody>
                            @foreach($alunos as $aluno)
                              <tr>
                                <td>
                                  Nome
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->nome}} {{$aluno->sobrenome}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  Sexo
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->sexo}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  CPF
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->cpf}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  CEP
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->cep}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  Logradouro
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->logradouro}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  Número
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->numero}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  Cidade
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->cidade}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  Bairro
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->bairro}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  Estado
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->estado}}</span>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  Data Cadastro
                                </td>
                                <td class="right vertical-middle">
                                  <span class="text-orange text-muted">{{$aluno->created_at}}</span>
                                </td>
                              </tr>

                            @endforeach



                          </tbody>
                        </table>

                        <!--  ===== FIM DADOS DO PERFIL DE ALUNO ================================================= -->
                    </div>

                    <div class="tab-pane" id="two">
                      <h5> Editar dados pessoais </h5>

                      <div class="card">
                        <div class="card-block">

                          {!! Form::model($alunos[0], [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['users.uperfil', $alunos[0]->id ]]) !!}
                            @if(isset($alunos[0]->img_perfil))
                            <div class="form-group row">
                            	<div class="col-sm-9">
                            		<img src="{{asset('/').$alunos[0]->img_perfil}}" class="img-circle img-thumbnail" alt="Perfil" width="50"> 
                            	
                            		
                            	</div>
                            </div>
                            @endif
                            <div class="form-group row">
                              <label for="inputNome" class="col-sm-3 form-control-label">Foto Perfil</label>
                              <div class="col-sm-9">
                                
                                {!! Form::file('image', null,['class'=>'form-control','required'=>"", 'id'=>'imgPerfil']) !!}
                              
                              	<small class="text-help">Imagem recomendada no tamanho 150x150 menor que 100kb.</small>
                              </div>
                            </div>
                            
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

                                {!! Form::text('cpf', null,['class'=>'form-control','required'=>"", 'id'=>'inputCpf', 'placeholder'=>'CPF']) !!}
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

                                
                              	<select id="form-register-estado" name="estado" class="form-control bg-white select2-hidden-accessible" required="" aria-required="true" tabindex="-1" aria-hidden="true">
                      					
                      					<option value="{{$alunos[0]->estado}}" selected>{{$alunos[0]->estado}}</option>
                      					<option value="AC">AC</option>
                      					<option value="AL">AL</option>
                      					<option value="AP">AP</option>
                      					<option value="AM">AM</option>
                      					<option value="BA">BA</option>
                      					<option value="CE">CE</option>
                      					<option value="DF">DF</option>
                      					<option value="ES">ES</option>
                      					<option value="GO">GO</option>
                      					<option value="MA">MA</option>
                      					<option value="MT">MT</option>
                      					<option value="MS">MS</option>
                      					<option value="MG">MG</option>
                      					<option value="PA">PA</option>
                      					<option value="PB">PB</option>
                      					<option value="PR">PR</option>
                      					<option value="PE">PE</option>
                      					<option value="PI">PI</option>
                      					<option value="RJ">RJ</option>
                      					<option value="RN">RN</option>
                      					<option value="RS">RS</option>
                      					<option value="RO">RO</option>
                      					<option value="RR">RR</option>
                      					<option value="SC">SC</option>
                      					<option value="SP">SP</option>
                      					<option value="SE">SE</option>
                      					<option value="TO">TO</option>
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


              <div class="card">
                <div class="card-header">Faturas (6 últimas)</div>
                <table class="table table-bordered">
                  <thead>
                    <tr>

                      <th>ID</th>
                      <th>STATUS</th>
                      <th>VER</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($faturas as $fatura)
                    <tr>
                      <td><?php echo (trim($fatura->status) == "Aguardando pagamento" )? "Aguardando": $fatura->status; ?></td>
                      <td>{{$fatura->created_at}}</td>
                      <td><a onclick="openModal(this);" data-ref="{{$fatura->transaction_id}}" href="#meu-perfil"><i class="material-icons">visibility</i> </a></td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
            </div>


	

        </div>
        <!-- // END column -->
		@endif
		
		
      </div>
      <!--  ======== modal personalizado ============== -->
        <div id="myModal" class="modal" style="z-index: 999 !important; position: absolute;">
          <span class="close cursor" onclick="closeModal()">&times;</span>
          <div class="modal-content">

            <div id="conteudo-ajax" style="background-color: #fff; height: 500px;padding: 20px;">
              Carregando...

            </div>


          </div>
        </div>

        <script>
        function openModal(url) {
          document.getElementById('myModal').style.display = "block";
          var code = url.getAttribute("data-ref");
          console.log(url.getAttribute("data-ref"));
          //carregar os dados via ajax da compra
          $.ajax({
            url: "{{asset('area-aluno/getpagamentobycode/')}}/"+code,
            type: "get",
            dataType: "json",
            success: function(data){


              var status=data.status;
              switch (status) {
                case "1":
                    status = "Aguardando pagamento";
                  break;

               case "2":
                    status = "Em análise";
                  break;

               case "3":
                   status = "Paga";
                 break;

               case "4":
                   status = "Disponível";
                 break;

               case "5":
                    status = "Em disputa";
                  break;

               case "6":
                   status = "Devolvida";
                 break;

               case "7":
                   status = "Cancelada";
                 break;
              }
              console.log(data);
              $('#conteudo-ajax').html("Carregando...");
              var linkPagamento = (status == "Aguardando pagamento" || status == "Em análise")? '<a href="'+data.paymentLink+'" target="_blank">REALIZAR PAGAMENTO</a>' :'NENHUMA';
              var htmlTR = '<div class="card">'+
                                '<div class="card-header">Detalhes da sua Compra no PagSeguro</div>'+
                                '<table class="table table-bordered">'+
                                  '<tbody>'+
                                    '<tr>'+
                                      '<td>CODIGO</td>'+
                                    '<td>VALOR</td>'+
                                      '<td>DATA</td>'+
                                      '<td>Pendências</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                      '<td><span style="font-size: 11px;">'+data.code +'</span></td>'+
                                      '<td>R$ '+data.grossAmount +'</td>'+
                                      '<td>'+data.date+'</td>'+
                                      '<td>'+linkPagamento+'</td>'+
                                    '</tr>'+
                                  '</tbody>'+
                                '</table>'+
                              '</div>';
                $('#conteudo-ajax').html(htmlTR);
            }
          });
        }

        function closeModal() {
          document.getElementById('myModal').style.display = "none";
        }


        </script>
@endsection
