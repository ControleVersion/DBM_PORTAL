<?php
	/*
		administrar PDFs do Menu administrativo
	*/
?>
@extends('layouts.dashboard')

@section('content')
<div class="col-md-12">

        @if(Session::has('success'))
          <div class="alert-box success">
          <h2>{!! Session::get('success') !!}</h2>
          </div>
        @endif

			{!! Form::open(['route'=>'apply.upload','method'=>'post','files'=>true, 'class'=>'form-horizontal']) !!}



					<!-- <input type="file" class="form-control-file" name="imagem_destaque" id="imagem_destaque"> -->

				<fieldset class="form-group">
						<label for="Imagem_Destaque">Imagem destaque</label>
			  		<p class="errors">{!!$errors->first('image')!!}</p>
							@if(Session::has('error'))
									<p class="errors">{!! Session::get('error') !!}</p>
							@endif
	      	{!! Form::file('image', ['class'=>'form-control-file', 'id'=>'upload']) !!}
					<small class="text-help">Imagem no tamanho 1296x546 menor que 500kb.</small>
				</fieldset>

				<fieldset class="form-group">
					<label for="titulo">Titulo Destaque</label>

					{!! Form::text('titulo_destaque',null, ['class'=>'form-control', 'id'=>'titulo_destaque',  "placeholder"=>"Titulo"]) !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="exampleSelect1">Sub Título</label>

					{!! Form::text('subtitulo',null, ['class'=>'form-control', 'id'=>'subtitulo',  "placeholder"=>"Subtitulo"]) !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="texto_link">Texto Link</label>

					{!! Form::text('texto_link',null, ['class'=>'form-control', 'id'=>'texto_link',  "placeholder"=>"Texto Link"]) !!}
				</fieldset>
				<fieldset class="form-group">
					<label for="exampleTextarea">Link do Botão</label>
					
					{!! Form::text('link_botao',null, ['class'=>'form-control', 'id'=>'link_botao',  "placeholder"=>"Link botão"]) !!}
				</fieldset>


				{!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
	      {!! Form::close() !!}

</div>


@endsection
