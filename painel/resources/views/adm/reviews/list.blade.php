@extends('layouts.dashboard')

@section('content')
<div class="simplebar-scroll-content">
  <div class="simplebar-content">
    <div class="container-fluid">



          <div class="tab-content p-a-1 m-b-1"  style="margin-left: 50px;display: inline-block; width: 80%;">

            <div class="tab-pane  active" id="one" aria-expanded="false">

              <h5>Lista de avaliações dos alunos</h5>

              <hr>

              <!-- ===== LISTAR ==================== -->
              <div class="card" id="listar-banners">
                <div class="card-header">Avaliações Cadastrados</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Aluno</th>
                      <th>Nota Avaliada</th>
					  <th>Status</th>
                      <th>Data</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x=0;?>
                    @foreach($reviews as $review)

                    <tr class="<?php echo ($x == 0)?  'table-active': '';?>">
                      <th scope="row">{{$review->review_id}}</th>
                      <td>{{$review->name}}</td>
                      <td>{{$review->review}}</td>
					  <td>{{$review->status}}</td>
                      <td>{{$review->created_at}}</td>
                      <td>
                        <button onclick="javascript:window.location.href='{{asset('adm/reviews/edit/')}}/{{$review->review_id}}'" type="button" class="btn btn-white btn-sm">
                          <i class="material-icons">edit</i>
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
                        <li class="paginate_button {{ ($reviews->currentPage() == 1) ? ' disabled' : '' }}">
                            <a href="{{ $reviews->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $reviews->lastPage(); $i++)
                            <li class="paginate_button {{ ($reviews->currentPage() == $i) ? ' active' : '' }}">
                                <a href="{{ $reviews->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="paginate_button {{ ($reviews->currentPage() == $reviews->lastPage()) ? ' disabled' : '' }}">
                            <a href="{{ $reviews->url($reviews->currentPage()+1) }}" >Próximo</a>
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
