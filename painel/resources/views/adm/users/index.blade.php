@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



          <div class="tab-content p-a-1 m-b-1"  style="margin-left: 50px;display: inline-block; width: 80%;">

            <div class="tab-pane  active" id="one" aria-expanded="false">

              <h5>Lista de usuários de sistema</h5>

              <hr>

              <!-- ===== LISTAR ==================== -->
              <div class="card" id="listar-banners">
                <div class="card-header">Usuários Cadastrados</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>email</th>
						<th>Tipo</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x=0;?>
                    @foreach($users as $user)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$user->id}}</th>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{($user->type == "admin")?"Administrador": "Aluno"}}</td>
                      <td>
                      	@if($user->type != "admin")
                        <button onclick="javascript:window.location.href='{{asset('adm/users/view/')}}/{{$user->id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
                          <span class="icon-text"></span>
                        </button>
                        @endif


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
                        <li class="paginate_button {{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
                            <a href="{{ $users->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <li class="paginate_button {{ ($users->currentPage() == $i) ? ' active' : '' }}">
                                <a href="{{ $users->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="paginate_button {{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
                            <a href="{{ $users->url($users->currentPage()+1) }}" >Próximo</a>
                        </li>
                    </ul>
                  </div>
                </div>

              </div>
              <!-- ===== FIM LISTAR ================ -->


            </div>


            </div>
        </div>
      </div>

      </div>
  </div>
</div>

@endsection
