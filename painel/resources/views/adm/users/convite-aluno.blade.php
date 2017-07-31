
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-sm-12 col-md-12 col-md-offset-1" style="margin-bottom: 400px;">
   <h3> Convidar Alunos Presenciais em Lote</h3>

   <div class="col-sm-6 col-md-6" id="cadastrar-sobre">
     <div class="card">
       <div class="card-block">
         <h5>Convidar Novos</h5>

       {!! Form::open(['route'=>'convidar.store','method'=>'post', 'class'=>'form-horizontal']) !!}
		<!--
       <fieldset class="form-group">
           <label for="Email_Convite">Nome do aluno</label>

         {!! Form::text('name', null,['class'=>'form-control','required'=>"", 'id'=>'email']) !!}

       </fieldset>
       -->

         <fieldset class="form-group">
             <label for="Email_Convite">Alunos cadastrados na Lista <br> (Recomenda-se testar a validade dos emails antes de disparar)
             	<br>Selecione grupos de 50 em 50, segurando a tecla CTRL do seu teclado, 
             	<br>envios de lotes de convites acima de 50 pode sobrecarregar o servidor e entrar em BlackList. 
             </label>

           
           	<select style="height: 300px;" multiple name="email[]" class="form-control" id="sel2">
        		@foreach($listadealunos as $alunos)
        			@if($alunos->status == "Pendente")
        				<option style="color:red !important;" value="{{$alunos->id}}">{{$alunos->nome}} - [{{$alunos->email}}] 
        				[{{$alunos->status}}] </option>
        			@else
        				<option style="color:green !important;" value="{{$alunos->id}}">{{$alunos->nome}} - [{{$alunos->email}}] 
        				[{{$alunos->status}}] </option>
        			@endif
        		@endforeach
      		</select>

         </fieldset>
         


         {!! Form::submit( 'ENVIAR', array('class'=>'btn btn-primary')) !!}
         {!! Form::close() !!}
       </div>
     </div>
   </div>
   <!-- ============ FIM DO convidar ===== -->


 </div>
 @endsection
