
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar profissional</h1>

   {!! Form::model($profissional, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['profissionais.update', $profissional->id ]]) !!}



       <fieldset class="form-group">
           <label for="Descricao"> Título </label>

         {!! Form::text('nome', null,['class'=>'form-control','required'=>"", 'id'=>'nome']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Miniatura </label>
           <br>
         <img src="{{ url('/').'/'.$profissional->foto }}" alt="Miniatura" width="300" />
         {!! Form::file('image', ['class'=>'form-control-file', 'id'=>'upload']) !!}
         <small class="text-help">Imagem no tamanho 370x370 menor que 250kb.</small>
       </fieldset>


       <fieldset class="form-group">
         <label for="texto_link">Formação / Atuação</label>

         {!! Form::text('formacao',null, ['class'=>'form-control', 'id'=>'formacao']) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="descricao">Descrição curta</label>

         {!! Form::textarea('descricao',null, ['class'=>'form-control', 'id'=>'descricao']) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="texto_link">Facebook URL</label>

         {!! Form::text('facebook',null, ['class'=>'form-control', 'id'=>'facebook']) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="texto_link">Instagram URL</label>

         {!! Form::text('instagram',null, ['class'=>'form-control', 'id'=>'instagram']) !!}
       </fieldset>




       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/profissionais')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
