
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Informações da Empresa</h1>

   {!! Form::model($configuracoes, [ 'method' => 'PUT',  'class'=>'form-horizontal','route' => ['configuracoes.update', $configuracoes->id ]]) !!}



       <fieldset class="form-group">
           <label for="Descricao"> Nome </label>

         {!! Form::text('nome', null,['class'=>'form-control','required'=>"", 'id'=>'nome']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Email contato </label>

         {!! Form::text('email_contato', null,['class'=>'form-control','required'=>"", 'id'=>'email_contato']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Telefone </label>

         {!! Form::text('telefone', null,['class'=>'form-control','required'=>"", 'id'=>'telefone']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Youtube </label>

         {!! Form::text('youtube', null,['class'=>'form-control', 'id'=>'telefone']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Facebook </label>

         {!! Form::text('facebook', null,['class'=>'form-control', 'id'=>'facebook']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Twitter </label>

         {!! Form::text('twitter', null,['class'=>'form-control', 'id'=>'Twitter']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Instagram </label>

         {!! Form::text('instagram', null,['class'=>'form-control', 'id'=>'Instagram']) !!}

       </fieldset>

       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/configuracoes/rodape')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
