@extends('layouts.site.site')

@section('content')
<main class="page-content section-70 section-md-114">
  <h2 class="text-bold" id="mainTitle">O que você irá encontrar no DBM</h2>

  @foreach($dbmcursos as $dbmcurso)
  <!-- bloco de info -->
   <section id="info-1" class="section-50 section-info" >
    <div class="shell">
      <div class="range text-sm-left range-sm-justify">
        <div class="cell-sm-7">
          <!-- inserção de código novo para ajuste da responsividade do video e layout -->
          <div id="info-1-video">
            <div id="info-1-video" class="js-player embed-responsive embed-responsive-16by9">
              <div data-type="youtube" data-video-id="{{$dbmcurso->video_id}}"></div>
            </div>
          </div>
          <!-- inserção de código novo para ajuste da responsividade do video e layout -->
        </div>
        <div class="cell-sm-5 offset-top-50 offset-sm-top-0">
           <h4 id="info-1-title" class="text-bold">{{$dbmcurso->titulo}}</h4>
          <hr class="divider bg-madison hr-sm-left-0">
          <div class="offset-top-30">
            <p id="info-1-TXT">{{$dbmcurso->descricao}}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- bloco de info -->
  @endforeach




</main>
<!-- Plyr core script -->
<script src="https://cdn.plyr.io/2.0.12/plyr.js"></script>
<!-- Docs script -->
<script src="https://cdn.plyr.io/2.0.12/demo.js"></script>
<!-- Rangetouch to fix <input type="range"> on touch devices (see https://rangetouch.com) -->
<script src="https://cdn.rangetouch.com/0.0.9/rangetouch.js" async=""></script>

<script type="text/javascript">
  	setTimeout(function(){
  		ativarMenu("dbm-curso");
  	}, 1500);

</script>

@endsection
