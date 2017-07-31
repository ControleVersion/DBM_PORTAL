
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Categoria</h1>

   {!! Form::model($category, [ 'method' => 'PUT',  'class'=>'form-horizontal','route' => ['categories.update', $category->id ]]) !!}



       <fieldset class="form-group">
           <label for="Descricao"> Nome </label>

         {!! Form::text('nome', null,['class'=>'form-control','required'=>"", 'id'=>'nome']) !!}

       </fieldset>

       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/categories')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
