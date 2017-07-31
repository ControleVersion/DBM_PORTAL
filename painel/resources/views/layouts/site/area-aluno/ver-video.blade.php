@extends('layouts.site.area-aluno.default')

@section('content')

 <!-- Right Sidebars -->
 <!-- Content -->
<!--  <div class="layout-content" data-scrollable>
   <div class="container-fluid"> -->
     <!-- Row -->
     <!-- @ #if(Auth::check()) -->
            @if($videoaulas[0]->category_id != 1)
                <input type="hidden" name="cpf-aluno" value="{{$aluno[0]->cpf}}">
                <input type="hidden" name="nome-aluno" value="{{Auth::user()->name}}">
                <input type="hidden" name="categoryId" value="{{$videoaulas[0]->category_id}}">
            @else
                <input type="hidden" name="cpf-aluno" value="{{$aluno[0]->cpf}}">
                <input type="hidden" name="nome-aluno" value="{{Auth::user()->name}}">
                <input type="hidden" name="categoryId" value="{{$videoaulas[0]->category_id}}">
            @endif

     <div class="row">
       <section id="DBMaulaVideo" >
         <!-- video -->
         <div id="videoWrapperRespo" class="col-md-9 col-lg-9">
           <div id="videoWrapper" class="js-player embed-responsive embed-responsive-16by9">
             <!-- essa div deve receber o id do video do yt
             precisamos esconder esse elemento para ele não aparecer no código fonte.
             isso é para dificultar os usuários pegarem o id e acharem o video no yt.
             os videos estarão postados como não listados -->
             <!-- como conversamos cripitografar o data-video-id -->
             <div data-type="youtube" data-video-id="{{$videoaulas[0]->id_youtube }}" data-plyr='{ "autoplay": true }'></div>
             <!-- como vc sugere que façamos isso?? -->
           </div>
         </div>
         <!-- video -->
         <!-- informações -->
         <div id="info-box" class="col-lg-3 col-md-3">
           <div class="card info-box-dbm">
             <div class="card-block">
             <h6>Informações do Aula</h6>
             <hr>
               <!-- #info-box-dbm-list -->
               <ul id="info-box-dbm-list">
                 <li>
                   <!-- passar o nome do professor que deu a aula -->
                   <b>Professor: </b><span id="info-professor"> {{$videoaulas[0]->nome }} </span>
                 </li>
                 <li>
                   <!-- passar o tema cadastrado da aula -->
                   <b>Tema: </b><span id="info-tema"> {{$videoaulas[0]->tema }} </span>
                 </li>
                 <li>
                   <!-- passar a data de cadastro no sistema -->
                   <b>Postado em: </b><span id="info-data"> {{ date('d/m/Y', strtotime($videoaulas[0]->created_at))  }} </span>
                 </li>
                 <li>
                   <!-- isso vem do video YT via js. já está pronto -->
                   <b>Duração: </b><span id="info-duracao"></span>
                 </li/>
                 <hr>
                 <li>
                   <!-- deve recever os resumo da aula -->
                   <b>Resumo: </b>
                   <span id="info-resumo">
                      {{$videoaulas[0]->resumo }}
                   </span>
                 </li>
                 <hr>
                 <li>
                   <b>Material para download:</b>
                     <div id="materialWrapper" class="row">
                       <div class="col-lg-6 col-md-6 col-xs-6">
                         <span class="text-center">
                         <!-- passar o link do documento relacionado a aula para download -->
                           @if($videoaulas[0]->material_01 != '')
                              <br>
                              @if (strpos($videoaulas[0]->material_01, '.pdf') !== false)
                                 <a target="_blank"  class="downloadFile" href="{{asset('/')}}/{{$videoaulas[0]->material_01}}">
                                   <img src="{{asset('site/area-aluno/images/pdf-ico.png')}}" alt="PDF" width="40">
                                 </a>
                              @endif

                              @if (strpos($videoaulas[0]->material_01, '.doc') !== false || strpos($videoaulas[0]->material_01, '.docx') !== false)
                                 <a target="_blank"  class="downloadFile" href="{{asset('/')}}/{{$videoaulas[0]->material_01}}">
                                   <img src="{{asset('site/area-aluno/images/doc-ico.png')}}" alt="DOCX" width="40">
                                 </a>
                              @endif
                            @endif
                         </span>
                       </div>
                       <div class="col-lg-6 col-md-6 col-xs-6">
                         <!-- passar o link do documento relacionado a aula para download -->
                         @if($videoaulas[0]->material_02 != '')
                            <br>
                            @if (strpos($videoaulas[0]->material_02, '.pdf') !== false)
                               <a target="_blank" class="downloadFile" href="{{asset('/')}}/{{$videoaulas[0]->material_02}}">
                                 <img src="{{asset('site/area-aluno/images/pdf-ico.png')}}" alt="PDF" width="40">
                               </a>
                            @endif

                            @if (strpos($videoaulas[0]->material_02, '.doc') !== false || strpos($videoaulas[0]->material_02, '.docx') !== false)
                               <a target="_blank"  class="downloadFile" href="{{asset('/')}}/{{$videoaulas[0]->material_02}}">
                                 <img src="{{asset('site/area-aluno/images/doc-ico.png')}}" alt="DOCX" width="40">
                               </a>
                            @endif
                          @endif
                       </div>


                     </div>
                 </li>
               </ul>
               <!-- #info-box-dbm-list final -->

             </div>
           </div>
         </div>
         <!-- informações -->
       </section>
     </div>
     <!-- // END Row -->
<!--    </div>
 </div> -->


 @endsection
