
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Depoimento </h1>

   {!! Form::model($depoimento, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['depoimentos.update', $depoimento->id ]]) !!}



       <fieldset class="form-group">
           <label for="Descricao"> Sub Título </label>

         {!! Form::textarea('comentario', null,['class'=>'form-control','required'=>"", 'id'=>'comentario']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Descricao"> Nome </label>

         {!! Form::text('nome', null,['class'=>'form-control','required'=>"", 'id'=>'nome']) !!}

       </fieldset>



       <fieldset class="form-group">
         <label for="texto_link">Profissão</label>

         {!! Form::text('profissao',null, ['class'=>'form-control', 'id'=>'profissao']) !!}
       </fieldset>

       <fieldset class="form-group">
         <label for="texto_link">Cidade</label>

         {!! Form::text('cidade',null, ['class'=>'form-control', 'id'=>'cidade']) !!}
       </fieldset>

       <fieldset class="form-group">
           <label for="Estado"> Estado </label>


             <select id="form-register-estado" name="estado"  class="form-control bg-white" required>
                 <option value="{{$depoimento->estado}}">{{$depoimento->estado}}</option>
                 <option value="AC">Acre</option>
                 <option value="AL">Alagoas</option>
                 <option value="AP">Amapá</option>
                 <option value="AM">Amazonas</option>
                 <option value="BA">Bahia</option>
                 <option value="CE">Ceará</option>
                 <option value="DF">Distrito Federal</option>
                 <option value="ES">Espírito Santo</option>
                 <option value="GO">Goiás</option>
                 <option value="MA">Maranhão</option>
                 <option value="MT">Mato Grosso</option>
                 <option value="MS">Mato Grosso do Sul</option>
                 <option value="MG">Minas Gerais</option>
                 <option value="PA">Pará</option>
                 <option value="PB">Paraíba</option>
                 <option value="PR">Paraná</option>
                 <option value="PE">Pernambuco</option>
                 <option value="PI">Piauí</option>
                 <option value="RJ">Rio de Janeiro</option>
                 <option value="RN">Rio Grande do Norte</option>
                 <option value="RS">Rio Grande do Sul</option>
                 <option value="RO">Rondônia</option>
                 <option value="RR">Roraima</option>
                 <option value="SC">Santa Catarina</option>
                 <option value="SP">São Paulo</option>
                 <option value="SE">Sergipe</option>
                 <option value="TO">Tocantins</option>
             </select>


       </fieldset>

       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/list')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
