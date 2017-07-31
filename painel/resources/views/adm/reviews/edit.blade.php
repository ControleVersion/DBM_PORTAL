
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Avaliação do Aluno</h1>

   {!! Form::model($review, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['reviews.update', $review->review_id ]]) !!}

		<fieldset class="form-group">
           <label for="Descricao"> Aluno</label>

         {!! Form::text('name', null,['class'=>'form-control','disabled'=>"disabled", 'id'=>'status']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Status</label>

      
		 <select name="status" id="status" class="form-control">]
			<option value="Ativo" {{ ($review->status == "Ativo")? "selected":'' }}>Ativo</option>
			<option value="Inativo" {{ ($review->status == "Inativo")? "selected":'' }}>Inativo</option>
		 </select>

       </fieldset>

       <fieldset class="form-group">
           <label for="Imagem_Destaque">Nota avaliada</label>

            {!! Form::text('review', null,['class'=>'form-control',"maxlength"=>"100",'disabled'=>"disabled", 'id'=>'review']) !!}
           
       </fieldset>

		<fieldset class="form-group">
           <label for="Imagem_Destaque">Comentário</label>

            {!! Form::textarea('coment', null,['class'=>'form-control',"maxlength"=>"100", 'id'=>'review']) !!}
           
       </fieldset>



       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/reviews/listar')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
