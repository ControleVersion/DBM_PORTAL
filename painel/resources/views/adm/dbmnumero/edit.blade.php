
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar DBM Número </h1>

   {!! Form::model($dbmnumero, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['dbmnumeros.update', $dbmnumero->id ]]) !!}



       <fieldset class="form-group">
           <label for="Descricao"> Icone</label>

         {!! Form::text('icone', null,['class'=>'form-control','required'=>"", 'id'=>'icone']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Numero </label>

         {!! Form::number('numero', null,['class'=>'form-control','required'=>"", 'id'=>'numero']) !!}

       </fieldset>



       <fieldset class="form-group">
         <label for="texto_link">Subtitulo</label>

         {!! Form::text('subtitulo',null, ['class'=>'form-control', 'id'=>'subtitulo']) !!}
       </fieldset>


       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/list')}}#four" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
