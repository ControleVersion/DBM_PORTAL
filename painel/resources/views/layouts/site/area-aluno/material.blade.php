@extends('layouts.site.area-aluno.default')

@section('content')

<!-- estrutura basica material -->
        <section class="card card-stats-primary DBMmaterial">
          <div class="card-block">
            <a href="#">
            <div class="media">
              <div class="media-left">
                <!-- avatar do professor que deu a aula -->
                <img src="{{asset('site/area-aluno/images/avatar_murilo.jpg')}}" alt="" class="img-circle" width="50">
              </div>
              <div class="media-body media-middle">
                <span>Bacterias...</span>
                <span> 10/10/2018</span>
              </div>
              <div class="media-right">
                <!-- avatar do professor que deu a aula -->
                <img src="{{asset('site/area-aluno/images/pdf-ico.png')}}" alt="" width="30">
              </div>
            </div>
            </a>
          </div>
        </section>
        <!-- estrutura basica material -->

        <!-- estrutura basica material -->
        <section class="card card-stats-primary DBMmaterial">
          <div class="card-block">
            <a href="#">
            <div class="media">
              <div class="media-left">
                <!-- avatar do professor que deu a aula -->
                <img src="{{asset('site/area-aluno/images/avatar_murilo.jpg')}}" alt="" class="img-circle" width="50">
              </div>
              <div class="media-body media-middle">
                <span>Bacterias...</span>
                <span> 10/10/2018</span>
              </div>
              <div class="media-right">
                <!-- avatar do professor que deu a aula -->
                <img src="{{asset('site/area-aluno/images/doc-ico.png')}}" alt="" width="30">
              </div>
            </div>
            </a>
          </div>
        </section>
        <!-- estrutura basica material -->
        <!-- // END Column -->
@endsection
