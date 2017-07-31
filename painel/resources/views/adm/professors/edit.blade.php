
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Professor</h1>

   {!! Form::model($professor, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['professors.update', $professor->id ]]) !!}



       <fieldset class="form-group">
           <label for="Nome"> Nome </label>

         {!! Form::text('nome', null,['class'=>'form-control','required'=>"", 'id'=>'nome']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="especialidade">Especialidade</label>

            {!! Form::text('especialidade', null,['class'=>'form-control',"maxlength"=>"100",'required'=>"", 'id'=>'especialidade']) !!}
      </fieldset>

       <fieldset class="form-group">
            @if($professor->foto_perfil != "")
              <img src="{{asset('/').$professor->foto_perfil}}"  class="img-circle"  alt="Perfil" width="80" />
            @endif
            <br>
           <label for="Resumo">Foto Perfil</label>

           {!! Form::file('foto_perfil', null,['class'=>'form-control',"maxlength"=>"200",'required'=>"", 'id'=>'foto_perfil']) !!}
           <small class="text-help"> Arquivo de imagem nos formatos .PNG, .JPG ou JPEG de no máximo 100x100 pixels e menor que 100k.</small>
       </fieldset>



       

       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/professors')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
