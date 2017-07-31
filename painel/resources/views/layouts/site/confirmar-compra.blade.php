@extends('layouts.site.site')

@section('content')
<section class="section-98 section-sm-110 section-bottom-66 section-20 section-md-114">
  <div class="shell">
    <div class="range range-xs-center section-34">
      <div class="cell-xs-12 cell-sm-8 cell-md-6 cell-lg-6">
        <!-- <h2 class="text-bold">Entrar</h2>
        <hr class="divider bg-madison"> -->
        <div class="offset-sm-top-45 text-center">
          @if(!isset($status))

          <div class="alert alert-info">
            <strong>Atenção!</strong> Erro durante a resposta de sua compra, por favor, entre em contato com o administrador.
          </div>
          @else
          <div class="alert alert-success">

            <strong>Parabéns!</strong> Sua compra encontra-se no Status <span style="font-size: 18px;">{{$status}}</span>.
            <p style="font-size: 14px;">
              Acompanhe por email o status de sua compra, assim que for confirmado o pagamento você receberá um email com o acesso ao seu curso. <br>
              Agradecemos e bons estudos!
            </p>

          </div>
          <?php
            //if($retorno == "Redirecionar"){
              //redirecionar para a tela de login
            //  header('Location: '.asset('registro#undefined1'));
            //}
          ?>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
