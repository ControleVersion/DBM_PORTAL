@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



      <div class="jumbotron text-center">
        <p>Adminsitrar Vídeo Aulas</p>
      </div>
      @if(Session::has('success'))
        <div class="alert-box success">
        <h3>{!! Session::get('success') !!}</h3>
        </div>
      @endif
      <h5>Lista de Vídeos</h5>
      <div class="card">
        <div class="card-block">

          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#one" data-toggle="tab" aria-expanded="false">Vídeos</a>
            </li>


          </ul>

          <div class="tab-content p-a-1 m-b-1"  style="display: inline-block; width: 100%;">
            <div class="tab-pane  active" id="one" aria-expanded="false">

              <button type="button" title="Listar" id="btn-listar" class="btn btn-success btn-circle">
                <i class="material-icons">list</i>
              </button>
              <button type="button" title="Cadastrar Novo" id="btn-cadastrar" class="btn btn-info btn-circle">
                <i class="material-icons">add</i>
              </button>

              <hr>

              <!-- ===== LISTAR ==================== -->
              <div class="card" id="listar-banners">
                <div class="card-header">Conteúdos Cadastrados</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tema</th>
                      <th>Data</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php  $x=0;  ?>
                    @foreach($videoaulas as $videoaula)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$videoaula->id}}</th>
                      <td>{{$videoaula->tema}}</td>
                      <td>{{$videoaula->created_at}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/videoaulas/edit/')}}/{{$videoaula->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>

                        <button type="button" onclick="delVideoaula({{$videoaula->id}})" class="btn btn-danger btn-sm">
                          <i class="material-icons">clear</i>

                        </button>
                      </td>
                    </tr>
                    <?php $x++;  ?>
                    @endforeach

                  </tbody>
                </table>




              </div>
              <!-- ===== FIM LISTAR ================ -->

              <!-- ==== CADASTRAR ===== -->
              <div class="col-md-12" id="cadastrar-banners" style="display: none;">
                <div class="card">
                  <div class="card-block">
                    <h5>Cadastrar Nova Vídeo Aula</h5>


                  {!! Form::open(['route'=>'videoaulas.store','files'=>true, 'method'=>'post', 'class'=>'form-horizontal']) !!}

                  <!--
                  'professor_id',
                  'category_id',
                  'tema',
                  'duracao',
                  'resumo',
                  'miniatura',
                  'material_01',
                  'material_02',
                  -->
                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">Titulo</label>
                        <input type="text" value="" maxlength="70"  name="tema" class="form-control" required>
                        <small class="text-help"> No máximo 80 caracteres.</small>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="Imagem_Destaque">ID do Vídeo no Youtube</label>
                        <input type="text"  value="" maxlength="100"  name="id_youtube" class="form-control" required>
                        <small class="text-help"> Inseira o ID do vídeo no Youtube. <br>Exemplo: https://www.youtube.com/watch?v=<b>GsTdan9dxRo</b> (apenas o ID em Negrito deve ser usado)</small>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="Resumo">Resumo</label>

                        <textarea maxlength="500" name="resumo" class="form-control" required></textarea>
                        <small class="text-help"> No máximo 200 caracteres.</small>
                    </fieldset>

                    <fieldset class="form-group">
                      <label> Professor </label>
                      <select class="form-control" name="professor_id" id="professor_id" required>
                        <option value="">Escolha</option>
                        @foreach($professors as $professor)
                          <option value="{{$professor->id}}">{{$professor->nome}}</option>
                        @endforeach
                      </select>
                    </fieldset>

                    <fieldset class="form-group">
                      <label> Categoria </label>
                      <select class="form-control" name="category_id" id="category_id" required>

                        @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->nome}}</option>
                        @endforeach
                      </select>
                    </fieldset>

                    <fieldset class="form-group">
                      <label> Referência </label>
                      <input type="text" class="form-control" name="reference" id="reference" value="" required />
                    </fieldset>

                    <fieldset class="form-group">
                      <label> Valor Promocional</label>
                      <input type="text" class="form-control" name="valor" id="reference" value="0.00" required />
                    </fieldset>
                    
                     <fieldset class="form-group">
       					<label>Valor Bruto</label>
       					<input type="text" class="form-control" name="valor_bruto" id="valor_bruto" value="0.00" required  />
       				</fieldset>

                    <fieldset class="form-group">
                      <label> Status </label>
                      <select class="form-control" name="status" id="status" required>
                          <option value="Ativo">Ativo</option>
                          <option value="Inativo">Inativo</option>

                      </select>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="miniatura">Imagem Miniatura do Vídeo</label required>
                        <input type="file" value=""  name="image" class="form-control" >
                        <small class="text-help">
                          Para listar os vídeo use uma imagem miniatura nos formatos .JPG, .PNG OU .GIF. Tamanho 300x200 pixels.
                          <br> Você pode também baixar a imagem configurada em seu vídeo do Youtube cadastrado, acessando o seguinte link:
                          <br> => https://img.youtube.com/vi/<b>ID_DO_SEU_VIDEO</b>/maxresdefault.jpg
                          <br>  Basta inserir o ID do vídeo corresponde ao seu Vídeo no Youtube.
                        </small>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="miniatura">Conteúdo de apoio 01</label>
                        <input type="file" value=""  name="image2" class="form-control" >
                        <small class="text-help"> Cadastre seu arquivo de apoio no formato .DOCX ou .PDF menor que 10MB. </small>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="miniatura">Conteúdo de apoio 02</label>
                        <input type="file" value=""  name="image3" class="form-control" >
                        <small class="text-help"> Cadastre seu arquivo de apoio no formato .DOCX ou .PDF menor que 10MB. </small>
                    </fieldset>



                    {!! Form::submit( 'CADASTRAR', array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
              <!--  =========== FIM DOS dbmcurso CADASTRADOS ============================ -->
            </div>



          </div>
        </div>
      </div>

      </div>
  </div>
</div>
<script type="text/javascript">
  setTimeout(function(){
    $('button#btn-cadastrar').click(function(){
      $('#cadastrar-banners').show();
      $('#listar-banners').hide();
    });
    $('button#btn-listar').click(function(){
      $('#cadastrar-banners').hide();
      $('#listar-banners').show();
    });


  }, 1500);
</script>
@endsection
