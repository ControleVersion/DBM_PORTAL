@extends('layouts.site.area-aluno.default')

@section('content')
<div class="row">

  @if (!Auth::guest())
    @if($aluno[0]->plano_acesso == "Presencial")
       <!-- Column -->
       <!-- estrutura básica video -->
       @foreach($videoaulas as $video)
       <section class="col-md-4 video-post">
         <div class="card">
           <div class="card-block">
             <div class="media">
               <div class="media-left media-middle">
                 <!-- avatar do professor que deu a aula -->
                 <img src="{{asset('site/images/person_perfil.png')}}" alt="" class="img-circle" width="50">
               </div>
               <div class="media-body media-middle">
                 <p class="card-subtitle">{{$video->nome}}</p>
                 <small>Data: {{ date('d/m/Y', strtotime($video->created_at))}}</small>
               </div>
             </div>
           </div>
           <a href="{{asset('area-aluno/videos/ver')}}/{{$video->id_youtube}}">
             <img src="{{asset('/')}}/{{$video->miniatura}}" alt="" width="100%">
           </a>
           <div class="card-block">
             <h4 class="card-title"> {{$video->tema}} </h4>
             <!-- <p>Nesta aula vamos falar sobre...</p> -->
           </div>
         </section>
        @endforeach
         <!-- estrutura básica video -->

       <!-- // END Column -->
    @else
      <div class="alert alert-info text-center" role="alert">
        Você ainda não possui um dos nossos cursos e treinamentos exclusivos? Aproveite agora mesmo e adiquira um <a href="{{asset('/comprar')}}" class="alert-link">CLIQUE AQUI</a>.
      </div>
    @endif
  @endif

</div>
@endsection
