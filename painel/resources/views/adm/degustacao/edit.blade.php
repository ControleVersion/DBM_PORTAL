
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Video Degustação </h1>

   {!! Form::model($degustacao, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['degustacao.update', $degustacao->id ]]) !!}



       <fieldset class="form-group">
           <label for="Descricao"> Sub Título </label>

         {!! Form::text('subtitulo', null,['class'=>'form-control','required'=>"", 'id'=>'subtitulo']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Descrição Curta </label>

         {!! Form::text('descricao_curta', null,['class'=>'form-control','required'=>"", 'id'=>'descricao_curta']) !!}

       </fieldset>


       <fieldset class="form-group">
         @if($degustacao->url_imagem != "")
         	<img src="{{asset('/').$degustacao->url_imagem}}" alt="Img" width="100" />
         @endif
         <br>
         <label for="exampleSelect1">Imagem destaque do vídeo</label>
         <br>
         <label class="file">

           {!! Form::file('image',null, ['class'=>'form-control', 'required'=>"", 'id'=>'file']) !!}
           <span class="file-custom"></span>
         </label>

       </fieldset>

       <fieldset class="form-group">
         <label for="texto_link">Link</label>

         {!! Form::text('link_externo',null, ['class'=>'form-control', 'id'=>'url_externa',  "placeholder"=>"Link"]) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="texto_link">Professor</label>
         <br>
         <select class="c-select" id="professor_id" name="professor_id">
             @foreach($professors as $professor)

             <option value="{{$professor->id}}" <?php echo ($degustacao->professor_id == $professor->id)?'selected' :'';?>>{{$professor->nome}}</option>
             @endforeach
         </select>
       </fieldset>

       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/list')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
