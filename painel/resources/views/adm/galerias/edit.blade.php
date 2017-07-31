
@extends('layouts.dashboard')

@section('content')

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('fileinput/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
  <link href="{{asset('fileinput/themes/explorer/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
  <style type="text/css" media="screen">
    body {
        margin: 0 !important;
        font-family: Roboto,"Helvetica Neue",Arial,Helvetica,sans-serif !important;
        font-size: 1rem !important;
        line-height: 1.5 !important;
        color: #373a3c !important;
        background-color: rgba(0,0,0,.05) !important;
    }
    .bg-white {
        background: #fff;
    }
    .navbar {
        height: 56px;
        line-height: 56px;
        padding-top: 0;
        padding-bottom: 0;
        margin-bottom: 1.25rem;
        border-bottom: 1px solid rgba(0,0,0,.1);
    }
  </style>

@if(Session::has('success'))
  <div class="alert-box success">
  <h2>{!! Session::get('success') !!}</h2>
  </div>
@endif




                             

                             

                         

                                                               

<!-- ==================================================================== -->
                
  
  <div class="col-md-6 col-md-offset-1" style="margin-bottom: 400px;"> 

     <!-- ===== LISTAR ==================== -->
                             
                                

                                  {!! Form::model($galeria, [ 'method' => 'PUT','files'=>true,  'class'=>'form-horizontal','route' => ['galerias.update', $galeria->id ]]) !!}
                                     <fieldset class="form-group">
                                         <label for="Descricao"> Título </label>

                                       {!! Form::text('titulo', null,['class'=>'form-control','required'=>"", 'id'=>'titulo']) !!}

                                     </fieldset>

                                     <fieldset class="form-group">
                                         <label for="Descricao"> Miniatura </label>
                                         <br>
                                       <img src="{{ url('/').'/'.$galeria->url_thumb }}" alt="Miniatura" width="300" />
                                       {!! Form::file('image', ['class'=>'form-control-file', 'id'=>'upload']) !!}
                                       <small class="text-help">Imagem no tamanho 370x370 menor que 250kb.</small>
                                     </fieldset>



                                     <fieldset class="form-group">
                                       <label for="texto_link">Imagem destaque</label>
                                       <br>
                                      
                                       {!! Form::file('image2[]', ['class'=>'form-control-file', 'multiple','id'=>'upload2']) !!}
                                       <small class="text-help">Imagem no tamanho 1200x800 menor que 250kb.</small>
                                       <input type="hidden" value="{{$galeria->id}}" id="galery_id" name="galery_id">
                                     </fieldset>

                                     <fieldset class="form-group">
                                       <label for="texto_link">Descricao curta</label>

                                       {!! Form::textarea('descricao_curta',null, ['class'=>'form-control', 'id'=>'descricao_curta']) !!}
                                     </fieldset>



                                     {!! Form::submit( 'ATUALIZAR', array('class'=>'btn btn-primary')) !!}
                                     <a class="btn btn-warning" style="float: right;" st="" href="{{asset('adm/galerias')}}" >Voltar</a>
                                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                                 {!! Form::close() !!}

                              
                              <!-- ===== FIM LISTAR ================ -->
  </div>
  
 <script type="text/javascript">
  setTimeout(function(){
       
       
     //===============================
      /*
      $("#upload2").fileinput({
                uploadAsync: true,
                language: 'pt-BR',
                showPreview: true,
                allowedFileExtensions: ['jpg', 'png'],
                maxFileSize: 500,
                uploadUrl: "{{asset('adm/galerias/ajax-multiupload')}}",

                uploadExtraData: function() {
                    return {
                        userid: $("#userid").val(),
                        galery_id: $('#galery_id').val(),
                        username: $("#username").val(),
                        '_token': $('input[name="_token"]').attr('value')
                    };
                },
                initialPreview: [
                    "<img src='{{ url('/').'/'.$galeria->url_imagem }}' class='file-preview-image' width='180' alt='Desert' title='Desert'>"
                ],
                initialPreviewConfig: [
                  {
                      caption: '{{$galeria->url_imagem}}', 
                      width: '120px', 
                      url: 'http://localhost/avatar/delete', // server delete action 
                      key: 100, 
                      extra: {id: 100}
                  }
                ]
            });
      */
     
      jQuery.ajax({
          url: '{{url("/")}}/adm/galerias/get-multi-images/{{$galeria->id}}',
          type: 'get',
          dataType: 'json',
          success: function(content){
            console.log(content);
            var url_imagem;
            var imagens = [];
            var idImagem=[];
            var IdArray=[];
            for(i=0; i < content.length; i++){
              //objeto que traz as imagens jah cadastradas
              imagens.push("<img src='{{ url('/')}}"+content[i].url_imagem+"' class='file-preview-image kv-preview-data rotate-1' width='180' alt='Desert' title='Desert'>");
              //objeto que monta a dinamica para apagar e visualizar
              IdArray = { caption: '', 
                        width: '180px', 
                        url: '{{asset("adm/galerias/destroy-item-galery")}}/'+content[i].id,
                        key: content[i].id,  
                        extra: {
                          id: content[i].id,
                          '_token': $('input[name="_token"]').attr('value')
                        }
                    };
              idImagem.push(IdArray);
            }
            console.log(idImagem);
            //===================================================
              $("#upload2").fileinput({
                  uploadAsync: true,
                  language: 'pt-BR',
                  showPreview: true,
                  allowedFileExtensions: ['jpg', 'png'],
                  maxFileSize: 500,
                  uploadUrl: "{{asset('adm/galerias/ajax-multiupload')}}",

                  uploadExtraData: function() {
                      return {
                          userid: $("#userid").val(),
                          galery_id: $('#galery_id').val(),
                          username: $("#username").val(),
                          '_token': $('input[name="_token"]').attr('value')
                      };
                  },
                  initialPreview: imagens,
                  initialPreviewConfig: idImagem
              });
            //===================================================
           
          }
       });
  
  }, 1500);
</script>
 @endsection
