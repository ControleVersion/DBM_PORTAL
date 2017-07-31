@extends('layouts.site.site')

@section('content')
<section class="section-98 section-sm-110 section-bottom-66 section-20 section-md-114">
  <div class="shell">
    <div class="range range-xs-center section-34">
      <div class="cell-xs-12 cell-sm-8 cell-md-6 cell-lg-6">
        <!-- <h2 class="text-bold">Entrar</h2>
        <hr class="divider bg-madison"> -->
        <div class="offset-sm-top-45 text-center">
          <div data-type="horizontal" class="responsive-tabs responsive-tabs-classic horizontal">
            <ul data-group="tabs-group-default" class="resp-tabs-list tabs-1 text-center tabs-group-default">
              <li>Login</li>
              <li>Registrar</li>
            </ul>
            <div data-group="tabs-group-default" class="resp-tabs-container text-sm-left tabs-group-default">
              <div id="entrar">
                <!-- <form data-form-output="form-output-global" data-form-type="contact" method="post" action="" class="rd-mailform text-left"> -->
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                      {{ csrf_field() }}
                  <div class="form-group">
                    <label for="form-login-username" class="form-label form-label-outside">E-mail:</label>
                    <input  id="form-login-username" type="text" name="email" maxlength="80" class="form-control bg-white" placeholder="Digite seu e-mail" required>
                  </div>
                  <div class="form-group offset-top-15">
                    <label for="form-login-password" class="form-label form-label-outside">Senha:</label>
                    <input id="form-login-password" type="password" maxlength="20" name="password"  class="form-control bg-white" placeholder="Digite sua senha" required>
                  </div>

                  <div class="offset-top-20">
                    <button id="btn-logarse"  type="submit" class="btn btn-primary reveal-block reveal-lg-inline-block">Entrar</button>
                    <span class="inset-lg-left-20 text-middle small reveal-inline-block offset-top-20 offset-lg-top-0"><a target="_blank" href="{{asset('password/reset')}}">Esqueceu a senha?</a></span>
                  </div>
                </form>
              </div>

              <div id="registrar">
                <form id="form-registrar" method="post" action="{{ url('/register') }}" class="rd-mailform text-left">
                  {{ csrf_field() }}
                  <div class="form-group offset-top-15">
                    <label for="form-register-email" class="form-label form-label-outside">E-mail:</label>
                    <input id="form-register-email" maxlength="80" type="email" name="email" class="form-control bg-white bg-blue" placeholder="Digite seu e-mail" required>
                    <span id="error-val-e" style="color:red;"></span>
                  </div>
                  <div class="form-group">
                    <label for="form-register-nome" class="form-label form-label-outside">Nome:</label>
                    <input id="form-register-nome" type="text" name="name" maxlength="120"  class="form-control bg-white" placeholder="Digite seu nome" required>
                    <span id="error-val-n" style="color:red;"></span>
                  </div>
                  <div class="form-group">
                    <label for="form-register-sobrenome" class="form-label form-label-outside">Sobrenome:</label>
                    <input id="form-register-sobrenome" type="text" maxlength="120" name="sobrenome" class="form-control bg-white" placeholder="Digite seu sobrenome" required>
                    <span id="error-val-s" style="color:red;"></span>
                  </div>

                  <div class="form-group">
                    <span>Sexo:</span><br>
                    <label class="radio-inline text-black">
                      <input name="input-group-radio" value="Masculino" type="radio" class="">
                      Masculino </label>

                    <label class="radio-inline text-black">
                      <input name="input-group-radio" value="Feminino" type="radio" class="radio-custom">
                      Feminino </label>
                  </div>

                  <div class="form-group offset-top-15">
                    <label for="form-register-estado" class="form-label form-label-outside">Estado:</label>
                    <select id="form-register-estado" name="estado"  class="form-control bg-white" required>
                      <option value="0">Seleciono o seu estado</option>
                      <option value="AC">Acre</option>
                      <option value="AL">Alagoas</option>
                      <option value="AP">Amapá</option>
                      <option value="AM">Amazonas</option>
                      <option value="BA">Bahia</option>
                      <option value="CE">Ceará</option>
                      <option value="DF">Distrito Federal</option>
                      <option value="ES">Espírito Santo</option>
                      <option value="GO">Goiás</option>
                      <option value="MA">Maranhão</option>
                      <option value="MT">Mato Grosso</option>
                      <option value="MS">Mato Grosso do Sul</option>
                      <option value="MG">Minas Gerais</option>
                      <option value="PA">Pará</option>
                      <option value="PB">Paraíba</option>
                      <option value="PR">Paraná</option>
                      <option value="PE">Pernambuco</option>
                      <option value="PI">Piauí</option>
                      <option value="RJ">Rio de Janeiro</option>
                      <option value="RN">Rio Grande do Norte</option>
                      <option value="RS">Rio Grande do Sul</option>
                      <option value="RO">Rondônia</option>
                      <option value="RR">Roraima</option>
                      <option value="SC">Santa Catarina</option>
                      <option value="SP">São Paulo</option>
                      <option value="SE">Sergipe</option>
                      <option value="TO">Tocantins</option>
                    </select>
                    <span id="error-val-es" style="color:red;"></span>
                  </div>
					
				<!--
                  <div class="form-group offset-top-15">
                    <label for="form-register-cpf" class="form-label form-label-outside">CPF:</label>
                    <input id="form-register-cpf" type="text" name="cpf" maxlength="15" class="form-control bg-white" placeholder="Digite seu CPF" required>
                    <span id="error-val-c" style="color:red;"></span>
                  </div>
                  -->

                  <div class="form-group offset-top-15">
                    <label for="form-register-password" class="form-label form-label-outside">Senha:</label>
                    <input id="form-register-password" type="password" maxlength="20" name="password" class="form-control bg-white" placeholder="Escolha uma senha" required>
                    <span id="error-val" style="color: red; font-size: 12px;"></span>
                  </div>
                  <div class="form-group offset-top-15">
                    <label for="form-register-confirm-password" class="form-label form-label-outside">Confirme a senha:</label>
                    <input id="form-register-confirm-password" type="password" name="password_confirmation" maxlength="20" class="form-control bg-white" placeholder="Repita a senha escolhida" required>
                    <span id="error-val" style="color: red; font-size: 12px;"></span>
                    
                    <?php if(isset($_GET['access'])  && $_GET['access'] == "presencial"){ ?>
                      <input type="hidden" value="<?php echo $_GET['access'];?>" id="access" name="access">
                    <?php } ?>
                    
                  </div>
					
					         

                  <div class="form-group">
                    <label>
                    <input name=" value="concordo" type="checkbox" class="" checked="checked">
                    <span class="checkbox-custom-dummy"></span>Li e concordo com os <a href="termos-uso.html">Termos de Uso</a></label>
                  </div>	

                  <!-- ////////////////////////////////////////////////////////////// -->
                  <div class="offset-top-20">
                    <button id="btn-registrar" type="button" class="btn btn-primary">Registrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
function validarCPF(inputCPF){
    var soma = 0;
    var resto;
    inputCPF = inputCPF.replace(/[-.]/g, '');

    if(inputCPF == '00000000000') return false;
    for(i=1; i<=9; i++) soma = soma + parseInt(inputCPF.substring(i-1, i)) * (11 - i);
    resto = (soma * 10) % 11;

    if((resto == 10) || (resto == 11)) resto = 0;
    if(resto != parseInt(inputCPF.substring(9, 10))) return false;

    soma = 0;
    for(i = 1; i <= 10; i++) soma = soma + parseInt(inputCPF.substring(i-1, i))*(12-i);
    resto = (soma * 10) % 11;

    if((resto == 10) || (resto == 11)) resto = 0;
    if(resto != parseInt(inputCPF.substring(10, 11))) return false;
    return true;
}
//resgatando o email
setTimeout(function(){
  //desativar botao por padrao
  $('button#btn-registrar').prop('disabled', true);

  var getEmail = getCookie('useremail');
  $('#form-register-email').attr('value', getEmail);

  $('#form-register-nome').focusout(function(){
    if($("#form-register-nome").attr('value') == ""){
      $('button#btn-registrar').prop('disabled', true);
      $('#error-val-n').html("Campo obrigatório");
    }else {
      $('#error-val-n').html("");
    }
  });
  $('#form-register-sobrenome').focusout(function(){
    if($('#form-register-sobrenome').attr('value') == ""){
      $('button#btn-registrar').prop('disabled', true);
      $('#error-val-s').html("Campo obrigatório");
    }else {
      $('#error-val-s').html("");
    }
  });
  $('#form-register-estado').focusout(function(){
    if($('#form-register-estado').attr('value') ==""){
      $('button#btn-registrar').prop('disabled', true);
      $('#error-val-es').html("Campo obrigatório");
    }else {
      $('#error-val-es').html("");
    }
  });
  $('input[name="cpf"]').focusout(function(){
    if( $(this).attr('value') == '___.___.___-__' || $(this).attr('value') == ""){
      $('button#btn-registrar').prop('disabled', true);
      $('#error-val-c').show();
      $('#error-val-c').html("Campo CPF obrigatório");
        $('input[name="cpf"]').focus();
    }else {
      if(validarCPF( $(this).attr('value') )){
        $('#error-val-c').hide();
        $('#error-val-c').html("");
      } else {
        $('#error-val-c').show();
        $('#error-val-c').html("CPF inválido");
          $('input[name="cpf"]').focus();
      }

    }
    console.log("Validando CPF "+$(this).attr('value'));
  });

  $('#form-register-password').focusout(function(){
      if($('#form-register-email').attr('value') == "" || $(this).attr('value') == "" || $('input[name="cpf"]') == '___.___.___-__' ){

            $('#error-val-e').html("Campo obrigatório");
            $('button#btn-registrar').prop('disabled', true);
      } else{
        $('#error-val-c').hide();

      }
  });

  //validando se senhas sao iguais
  $('#form-register-confirm-password').focusout(function(){

    if($('#form-register-password').val() == "" || $(this).val() != $('#form-register-password').attr('value') || $('#form-register-password').attr('value') == "" ){
      $(this).attr('value', '');
      $('#error-val').show();
      $('#error-val').html("Senhas devem ser iguais");
      $('button#btn-registrar').prop('disabled', true);
    } else {
      $('#error-val').hide();
      $('button#btn-registrar').prop('disabled', false);
    }
    if( $(this).attr('value') == '___.___.___-__' || $(this).attr('value') == ""){
        $('input[name="cpf"]').focus();
        $('button#btn-registrar').prop('disabled', true);
    }
  });


  $('button#btn-logarse').prop('disabled', true);
  $('#form-login-password').focusout(function(){
    if($(this).attr('value') != ""){
      $('button#btn-logarse').prop('disabled', false);
    }
  });


  $('#btn-registrar').click(function(){

      return document.getElementById('form-registrar').submit();

  });
  
  //ativar o menu
  ativarMenu("registro");
}, 1500);
</script>

@endsection
