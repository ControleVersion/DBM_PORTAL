@extends('layouts.site.site')

@section('content')
<section class="section-98 section-sm-110 section-bottom-66 section-20 section-md-114">
  <div class="shell">
    <div class="range range-xs-center section-34">
      <div class="cell-xs-12 cell-sm-8 cell-md-6 cell-lg-6">
        <!-- <h2 class="text-bold">Entrar</h2>
        <hr class="divider bg-madison"> -->
        <div class="offset-sm-top-45 text-center">
          @if(!isset($_GET['id']))

          <div class="alert alert-info">
            <strong>Atenção!</strong> Para ativar o seu cadastro, entre na sua caixa de email e verifique o link de confirmação.
          </div>
          @else
          <div class="alert alert-success">

            <strong>Confirmado!</strong> Parabéns, você já pode acessar o conteúdo se logando no site.

          </div>
          <?php
            if($retorno == "Redirecionar"){
              //redirecionar para a tela de login
              header('Location: '.asset('registro#undefined1'));
            }
          ?>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
