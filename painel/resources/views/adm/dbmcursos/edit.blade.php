
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar</h1>

   {!! Form::model($dbmcurso, [ 'method' => 'PUT',  'class'=>'form-horizontal','route' => ['profissionais.update', $dbmcurso->id ]]) !!}



       <fieldset class="form-group">
           <label for="Descricao"> ID do Video Youtube </label>

         {!! Form::text('video_id', null,['class'=>'form-control','required'=>"", 'id'=>'video_id']) !!}

       </fieldset>


       <fieldset class="form-group">
         <label for="texto_link"> Titulo </label>

         {!! Form::text('titulo',null, ['class'=>'form-control', 'id'=>'formacao']) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="descricao">Descrição curta</label>

         {!! Form::textarea('descricao',null, ['class'=>'form-control', 'id'=>'descricao']) !!}
       </fieldset>




       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/dbmcurso')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
