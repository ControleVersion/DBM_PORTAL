
@extends('layouts.site.site')

@section('content')

<main class="page-content section-70 section-md-114">
<section>
  <div class="shell">
    <h2>Encontros DBM</h2>
    <hr class="divider bg-madison">
    <p>Momentos foram feitos para serem lembrados.</p>
    <div class="offset-top-60">

    <h3 id="DBM-ano-fotos">2017</h3>
      <div data-photo-swipe-gallery="gallery" class="range range-xs-center range-lg-condensed">
        <!-- estrutrura básica foto -->
        @foreach($galerias as $galeria)
          <div class="cell-xs-10 cell-sm-6 cell-md-4">
            <figure class="thumbnail-classic">
              <div class="thumbnail-classic-img-wrap"><img width="370" height="370" src="{{asset('/').$galeria->url_thumb}}" alt=""/><a class="gallery-link-mobile veil-lg" data-photo-swipe-item="" data-size="1200x800" href="{{asset('site/images/1200x800.jpg')}}"></a></div>
              <figcaption class="thumbnail-classic-caption text-center">
                <div>
                  <h4 class="thumbnail-classic-title"> {{$galeria->titulo}} </h4>
                </div>
                <hr class="divider divider-sm"/>
                <p> {{$galeria->descricao_curta}} </p>
                <div class="offset-top-20 veil reveal-lg-block">
                  <a class="icon icon-xxs fa-search-plus" target="_self" href="{{asset('galeria/view/').'/'.$galeria->id}}"></a>
                </div>
              </figcaption>
            </figure>
          </div>
          <!-- estrutrura básica foto -->
        @endforeach

        

      </div>
    </div>
  </div>
</section>
</main>
<script type="text/javascript">
    setTimeout(function(){
      ativarMenu("galeria");
    }, 1500);
  
</script>
@endsection
