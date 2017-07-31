
@extends('layouts.dashboard')

@section('content')

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif

 <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;">
   <h1> Editar Video Aula</h1>

   {!! Form::model($videoaula, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['videoaulas.update', $videoaula->id ]]) !!}



       <fieldset class="form-group">
           <label for="Descricao"> Tema / Título </label>

         {!! Form::text('tema', null,['class'=>'form-control','required'=>"", 'id'=>'tema']) !!}

       </fieldset>

       <fieldset class="form-group">
           <label for="Imagem_Destaque">ID do Vídeo no Youtube</label>

            {!! Form::text('id_youtube', null,['class'=>'form-control',"maxlength"=>"100",'required'=>"", 'id'=>'id_youtube']) !!}
           <small class="text-help"> Inseira o ID do vídeo no Youtube. <br>Exemplo: https://www.youtube.com/watch?v=<b>GsTdan9dxRo</b> (apenas o ID em Negrito deve ser usado)</small>
       </fieldset>

       <fieldset class="form-group">
           <label for="Resumo">Resumo</label>

           {!! Form::textarea('resumo', null,['class'=>'form-control',"maxlength"=>"500",'required'=>"", 'id'=>'resumo']) !!}
           <small class="text-help"> No máximo 200 caracteres.</small>
       </fieldset>

       <fieldset class="form-group">
         <label> Professor </label>
         <select class="form-control" name="professor_id" id="professor_id" required>
           <option value="">Escolha</option>
           @foreach($professors as $professor)
             @if($professor->id == $videoaula->professor_id)
               <option value="{{$professor->id}}" selected="selected">{{$professor->nome}}</option>
             @else
             <option value="{{$professor->id}}">{{$professor->nome}}</option>
             @endif
           @endforeach
         </select>
       </fieldset>

       <fieldset class="form-group">
         <label> Categoria </label>
         <select class="form-control" name="category_id" id="category_id" required>

           @foreach($categories as $category)
              @if($category->id == $videoaula->category_id)
                <option value="{{$category->id}}" selected="selected">{{$category->nome}}</option>
              @else
                <option value="{{$category->id}}">{{$category->nome}}</option>
              @endif
           @endforeach
         </select>
       </fieldset>

       <fieldset class="form-group">
         <label> Referência </label>
         <input type="text" class="form-control" name="reference" id="reference" value="{{$videoaula->reference}}" required />
       </fieldset>

		<fieldset class="form-group">
       		<label>Duração</label>
       		<input type="text" class="form-control" name="valor_bruto" id="valor_bruto" value="{{$videoaula->duracao}}" required  />
       </fieldset>

       <fieldset class="form-group">
         <label> Valor Promocional </label>
         <input type="text" class="form-control" name="valor" id="reference" value="{{$videoaula->valor}}" required />
       </fieldset>
       
       
       
       <fieldset class="form-group">
       		<label>Valor Bruto</label>
       		<input type="text" class="form-control" name="valor_bruto" id="valor_bruto" value="{{$videoaula->valor_bruto}}" required  />
       </fieldset>

       <fieldset class="form-group">
         <label> Status </label>
         <select class="form-control" name="status" id="status" required>
                  <option <?php echo ($videoaula->status == "Ativo")? 'selected':''?> value="Ativo">Ativo</option>
                  <option <?php echo ($videoaula->status == "Inativo")? 'selected':''?> value="Inativo">Inativo</option>
         </select>
       </fieldset>

       <fieldset class="form-group">
           <label for="miniatura">Imagem Miniatura do Vídeo</label required>
             @if($videoaula->miniatura != '')
              <input type="text" disabled value="{{$videoaula->miniatura}}"  name="miniatura" class="form-control" >
             @endif
           {!! Form::file('miniatura', null,['class'=>'form-control','value'=>'','required'=>"", 'id'=>'miniatura']) !!}
           <small class="text-help">
             Para listar os vídeo use uma imagem miniatura nos formatos .JPG, .PNG OU .GIF. Tamanho 300x200 pixels.
             <br> Você pode também baixar a imagem configurada em seu vídeo do Youtube cadastrado, acessando o seguinte link:
             <br> => https://img.youtube.com/vi/<b>ID_DO_SEU_VIDEO</b>/maxresdefault.jpg
             <br>  Basta inserir o ID do vídeo corresponde ao seu Vídeo no Youtube.
           </small>
      </fieldset>

       <fieldset class="form-group">
           <label for="miniatura">Conteúdo de apoio 01</label>
           @if($videoaula->material_01 != '')
              <br>
              @if (strpos($videoaula->material_01, '.pdf') !== false)
                <img src="{{asset('site/area-aluno/images/pdf-ico.png')}}" alt="PDF" width="40">
              @endif

              @if (strpos($videoaula->material_01, '.doc') !== false || strpos($videoaula->material_01, '.docx') !== false)
                <img src="{{asset('site/area-aluno/images/doc-ico.png')}}" alt="DOCX" width="40">
              @endif

            <input type="text" disabled value="{{$videoaula->material_01}}"  name="material_01" class="form-control" >
           @endif
           {!! Form::file('material_01', null,['class'=>'form-control','value'=>'', 'id'=>'material_01']) !!}
           <small class="text-help"> Cadastre seu arquivo de apoio no formato .DOCX ou .PDF menor que 10MB. </small>
       </fieldset>

       <fieldset class="form-group">
           <label for="miniatura">Conteúdo de apoio 02</label>
           @if($videoaula->material_02 != '')
                <br>
               @if (strpos($videoaula->material_02, '.pdf') !== false)
                 <img src="{{asset('site/area-aluno/images/pdf-ico.png')}}" alt="PDF" width="40">
               @endif

               @if (strpos($videoaula->material_02, '.doc') !== false || strpos($videoaula->material_02, '.docx') !== false)
                 <img src="{{asset('site/area-aluno/images/doc-ico.png')}}" alt="DOCX" width="40">
               @endif

            <input type="text" disabled value="{{$videoaula->material_02}}"  name="material_02" class="form-control" >
           @endif
           {!! Form::file('material_02', null,['class'=>'form-control','value'=>'', 'id'=>'material_02']) !!}
           <small class="text-help"> Cadastre seu arquivo de apoio no formato .DOCX ou .PDF menor que 10MB. </small>
       </fieldset>

       {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
       <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/videoaulas/listar')}}" >Voltar</a>

   {!! Form::close() !!}


 </div>
 @endsection
