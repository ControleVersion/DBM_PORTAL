
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h3> Visualizar conteudo da mensagem enviada</h3>

   {!! Form::model($contatos, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['contatos.update', $contatos->id ]]) !!}

		  <fieldset class="form-group">
           <label for="Descricao"> Nome</label>

         {!! Form::text('name', null,['class'=>'form-control','disabled'=>"disabled", 'id'=>'status']) !!}

       </fieldset>

       <fieldset class="form-group">
            <label for="Descricao"> Sobrenome</label>

          {!! Form::text('last_name', null,['class'=>'form-control','disabled'=>"disabled", 'id'=>'last_name']) !!}

        </fieldset>

        <fieldset class="form-group">
             <label for="Descricao"> Email</label>

           {!! Form::text('email', null,['class'=>'form-control','disabled'=>"disabled", 'id'=>'email']) !!}

         </fieldset>

         <fieldset class="form-group">
              <label for="Descricao"> Telefone</label>

            {!! Form::text('phone', null,['class'=>'form-control','disabled'=>"disabled", 'id'=>'phone']) !!}

          </fieldset>



       <fieldset class="form-group">
           <label for="Imagem_Destaque">Mensagem</label>

            {!! Form::textarea('message', null,['class'=>'form-control','disabled'=>"disabled", 'id'=>'message']) !!}

       </fieldset>




       <!--
       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
      -->
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/contatos')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
