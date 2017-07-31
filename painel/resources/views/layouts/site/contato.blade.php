
@extends('layouts.site.site')

@section('content')
<section class="section-70 section-md-114">

  <?php
    $emailEmpresa = "";
    $telefoneEmpresa = "";
    $facebookEmpresa = "";
    $instagramEmpresa="";
    //resgatando o objeto armazenado na rota Session
    $empresaInfo = Session::get('empresaInfo');
    foreach($empresaInfo as $empresa){
      $emailEmpresa = $empresa->email_contato;
      $telefoneEmpresa = $empresa->telefone;
      $facebookEmpresa = $empresa->facebook;
      $instagramEmpresa = $empresa->instagram;
    }
  ?>

  <div class="shell">
    <div class="range range-xs-center">
      <div class="cell-xs-10 cell-md-8 text-md-left">
        <h2 class="text-bold">Entre em contato com a DBM</h2>
        <hr class="divider bg-madison hr-sm-left-0">

        <div class="offset-top-30">
          <div id="msg-final" class="alert alert-success" style="display: none;">
            <h4>Cadastrado contato com sucesso!</h4>
          </div>
          <form id="form-contato" method="post" action="{{asset('contato/store')}}" class="rd-mailform text-left">
            {{ csrf_field() }}
            <div class="range">
              <div class="cell-lg-6">
                <div class="form-group">
                  <label for="contact-me-name" class="form-label form-label-outside">Primeiro nome*</label>
                  <input id="contact-me-name" type="text" name="name" maxlength="80" class="form-control" required>
                </div>
              </div>
              <div class="cell-lg-6 offset-top-12 offset-lg-top-0">
                <div class="form-group">
                  <label for="contact-me-last-name" class="form-label form-label-outside">Sobrenome*</label>
                  <input id="contact-me-last-name" type="text" maxlength="80" name="last_name"  class="form-control">
                </div>
              </div>
              <div class="cell-lg-6 offset-top-12">
                <div class="form-group">
                  <label for="contact-me-email" class="form-label form-label-outside">E-mail*</label>
                  <input id="contact-me-email" type="email" maxlength="100" name="email" class="form-control" required>
                </div>
              </div>
              <div class="cell-lg-6 offset-top-12">
                <div class="form-group">
                  <label for="contact-me-phone" class="form-label form-label-outside">Telefone</label>
                  <input id="contact-me-phone" type="text" maxlength="20" name="phone" class="form-control" required>
                </div>
              </div>
              <div class="cell-lg-12 offset-top-12">
                <div class="form-group">
                  <label for="contact-me-message" class="form-label form-label-outside">Messagem</label>
                  <textarea id="contact-me-message" name="message" maxlength="300" style="height: 220px" class="form-control" required></textarea>
                </div>
              </div>
            </div>
            <div class="text-center text-lg-left offset-top-20">
              <button id="enviar-contato" type="button" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="cell-xs-10 cell-md-4 offset-top-65 offset-md-top-0 text-left">
        <div class="inset-md-left-30">
          <h6 class="text-bold">Redes Sociais</h6>
          <div class="hr bg-gray-light offset-top-10"></div>
          <ul class="list-inline list-inline-xs list-inline-madison">
            <li><a href="{{$facebookEmpresa}}" class="icon icon-xxs fa-facebook icon-circle icon-gray-light-filled"></a></li>
            <li><a href="{{$instagramEmpresa}}" class="icon icon-xxs fa-instagram icon-circle icon-gray-light-filled"></a></li>
          </ul>
          <div class="offset-top-30 offset-md-top-60">
            <h6 class="text-bold">Telefone</h6>
            <div>
              <div class="hr bg-gray-light offset-top-10"></div>
            </div>
            <div class="offset-top-15">
              <ul class="list list-unstyled">
                <li><span class="icon icon-xs text-madison mdi mdi-phone text-middle"></span>
                <a id="DBMphone2" href="tel:2199999999" class="text-middle inset-left-10 text-dark">{{$telefoneEmpresa}}</a></li>
              </ul>
            </div>
          </div>
          <div class="offset-top-30 offset-md-top-60">
            <h6 class="text-bold">E-mail</h6>
            <div>
              <div class="hr bg-gray-light offset-top-10"></div>
            </div>
            <div class="offset-top-15">
              <ul class="list list-unstyled">
                <li>
                  <span class="icon icon-xs text-madison mdi mdi-email-outline text-middle"></span>
                  <a href="mailto:{{$emailEmpresa}}" class="text-primary text-middle inset-left-10">{{$emailEmpresa}}</a>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

  <script>
  setTimeout(function(){
    $('button#enviar-contato').click(function(){
      var dados_form = $('form#form-contato').serializeArray();
      dados_form = JSON.stringify(dados_form);
      dados_form = $.parseJSON(dados_form);
      var $total = 0;
      for($i=0; $i < dados_form.length; $i++){
        if(dados_form[$i].value != ""){
            $total += 0;
        } else {
          $total += 1;
        }
      }
      if($total == 0){
         $('form#form-contato').submit();
         window.location.href="#msg-final";
         $('#msg-final').attr('class','alert alert-success');
         $('#msg-final').html("<span style='font-size: 12px;'> Enviado com sucesso!</span>");
         $('#msg-final').show();
      }else {
        window.location.href="#msg-final";
        $('#msg-final').attr('class', 'alert alert-warning');
         $('#msg-final').show();
         $('#msg-final').html("<span style='font-size: 12px;'>Preencha todos os campos obrigatórios...</span>");
      }
      //console.log($total);
    });
    $('input[name="phone"]').mask('(99) 9999-99999');
    //ativar menu
    ativarMenu("contato");
  }, 1500);


  </script>

@endsection
