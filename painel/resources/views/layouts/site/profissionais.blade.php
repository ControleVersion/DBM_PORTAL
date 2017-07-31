@extends('layouts.site.site')

@section('content')

<main class="page-content">
@foreach($profissionais as $profissional)
<!-- profissional -->
<section id="{{$profissional->id}}" class="section-70 section-md-114">
  <div class="shell">
    <div class="range range-xs-center">
      <div class="cell-sm-4 text-sm-left">
        <div class="inset-sm-right-30">
          <img src="{{asset('/').'/'.$profissional->foto}}" width="340" height="340" alt="" class="img-responsive reveal-inline-block">
          <div class="offset-top-15 offset-sm-top-30">
            <ul class="list-inline list-inline-xs list-inline-madison">
              <li><a href="{{$profissional->facebook}}" class="icon icon-xxs fa-facebook icon-circle icon-gray-light-filled"></a></li>
              <li><a href="{{$profissional->instagram}}" class="icon icon-xxs fa-instagram icon-circle icon-gray-light-filled"></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="cell-sm-8 text-left">
        <div>
          <h2 class="text-bold">{{$profissional->nome}}</h2>
        </div>
        <p class="offset-top-10">Professor (a) de {{$profissional->formacao}}</p>
        <div class="offset-top-15 offset-sm-top-30">
          <hr class="divider bg-madison hr-left-0">
        </div>
        <div class="offset-top-30 offset-sm-top-60">
          <h6 class="text-bold">Sobre</h6>
          <div class="text-subline"></div>
        </div>
        <div class="offset-top-20">
          <p> {{$profissional->descricao}} </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- profissional -->
@endforeach
</main>

<script type="text/javascript">
  	setTimeout(function(){
  		ativarMenu("profissionais");
  	}, 1500);
	
</script>

@endsection
