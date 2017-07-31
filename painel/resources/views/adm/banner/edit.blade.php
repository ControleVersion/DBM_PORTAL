
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Banner </h1>

   {!! Form::model($banner, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['banner.update', $banner->id ]]) !!}


       <fieldset class="form-group">
           <label for="Imagem_Destaque">Imagem destaque</label>
           <br>
           <img src="{{asset('/').'/'.$banner->url_imagem}}" class="img-responsive" alt="Img Banner" style="min-width: 436px !important; max-width: 436px !important;"/>
           <p class="errors">{!!$errors->first('image')!!}</p>
             @if(Session::has('error'))
                 <p class="errors">{!! Session::get('error') !!}</p>
             @endif
         {!! Form::file('image', null,['class'=>'form-control-file', 'id'=>'upload']) !!}
         <small class="text-help">Imagem no tamanho 1296x546 menor que 500kb.</small>
       </fieldset>

       <fieldset class="form-group">
         <label for="titulo">Titulo Destaque</label>

         {!! Form::text('titulo_destaque',null, ['class'=>'form-control', 'id'=>'titulo_destaque',  "placeholder"=>"Titulo"]) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="exampleSelect1">Sub Título</label>

         {!! Form::text('subtitulo',null, ['class'=>'form-control', 'id'=>'subtitulo',  "placeholder"=>"Subtitulo"]) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="texto_link">Texto Link</label>

         {!! Form::text('texto_link',null, ['class'=>'form-control', 'id'=>'texto_link',  "placeholder"=>"Texto Link"]) !!}
       </fieldset>
       <fieldset class="form-group">
         <label for="exampleTextarea">Link do Botão</label>

         {!! Form::text('link_botao',null, ['class'=>'form-control', 'id'=>'link_botao',  "placeholder"=>"Link botão"]) !!}
       </fieldset>


       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/list')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
