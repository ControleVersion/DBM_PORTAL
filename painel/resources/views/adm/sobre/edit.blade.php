
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Sobre </h1>

   {!! Form::model($sobre, [ 'method' => 'PUT', 'class'=>'form-horizontal','route' => ['sobre.update', $sobre->id ]]) !!}


       <fieldset class="form-group">
           <label for="Imagem_Destaque">Título</label>
           <br>
           {!! Form::text('titulo',null, ['class'=>'form-control', 'id'=>'titulo',  "placeholder"=>"Titulo"]) !!}
           <!-- <small class="text-help">Imagem no tamanho 1296x546 menor que 500kb.</small> -->
       </fieldset>

       <fieldset class="form-group">
         <label for="titulo">URL Youtube</label>

         {!! Form::text('url_youtube',null, ['class'=>'form-control', 'id'=>'URL YOUTUBE']) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="exampleSelect1">Descrição curta</label>

         {!! Form::text('descricao_curta',null, ['class'=>'form-control', 'id'=>'subtitulo']) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="texto_link">URL Externa</label>

         {!! Form::text('url_externa',null, ['class'=>'form-control', 'id'=>'url_externa',  "placeholder"=>"Texto Link"]) !!}
       </fieldset>
       

       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/list')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
