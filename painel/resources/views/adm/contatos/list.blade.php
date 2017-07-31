@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



          <div class="tab-content p-a-1 m-b-1"  style="margin-left: 50px;display: inline-block; width: 80%;">

            <div class="tab-pane  active" id="one" aria-expanded="false">

              <h5>Lista de contatos feitos no portal</h5>

              <hr>

              <!-- ===== LISTAR ==================== -->
              <div class="card" id="listar-banners">
                <div class="card-header">Cadastrados</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nome</th>
                      <th>Sobrenome</th>
                      <th>Email</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x=0;?>
                    @foreach($contatos as $contato)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$contato->id}}</th>
                      <td>{{$contato->name}}</td>
                      <td>{{$contato->last_name}}</td>
                      <td>{{$contato->email}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/contatos/view/')}}/{{$contato->id}}'" type="button" class="btn btn-warning btn-xs">
                          <i class="material-icons">visibility</i>
                          <span class="icon-text"></span>
                        </button>


                      </td>
                    </tr>
                    <?php $x++?>
                    @endforeach


                  </tbody>
                </table>

                <!-- PAGINACAO DOS BANNERS -->


                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="datatable-example_paginate">
                    <ul class="pagination">
                        <li class="paginate_button {{ ($contatos->currentPage() == 1) ? ' disabled' : '' }}">
                            <a href="{{ $contatos->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $contatos->lastPage(); $i++)
                            <li class="paginate_button {{ ($contatos->currentPage() == $i) ? ' active' : '' }}">
                                <a href="{{ $contatos->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="paginate_button {{ ($contatos->currentPage() == $contatos->lastPage()) ? ' disabled' : '' }}">
                            <a href="{{ $contatos->url($contatos->currentPage()+1) }}" >Próximo</a>
                        </li>
                    </ul>
                  </div>
                </div>
                
                

              </div>
              <!-- ===== FIM LISTAR ================ -->
				<div class="row">
                	<div class="col-sm-4" style="text-align: right;padding: 10px 0px 0px  0px;">
                		<small><b style="color: slategray;">Total recebidos: </b>  {{ $totalContatos}}</small>
                	</div>
                </div>
				
            </div>


            </div>
        </div>
      </div>

      </div>
  </div>
</div>

@endsection
