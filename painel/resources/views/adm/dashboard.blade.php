<!-- DASHBOARD CONTEUDO INICIAL -->
@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

  <!-- Breadcrumb -->


  <!-- Row -->
  <div class="row">

    <!-- Column -->
    <div class="col-md-8">

      <!--
      <div class="card">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" aria-expanded="false">
              <i class="material-icons">schedule</i> <span class="icon-text">Histórico</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" id="customers-tab" data-toggle="tab" href="#customers" aria-expanded="true">
              <i class="material-icons">person_add</i> <span class="icon-text">Sign Ups</span>
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade" id="history" aria-expanded="false">
            <ul class="list-group list-group-fit">
              <li class="list-group-item">
                <div class="media">
                  <div class="media-left media-middle">
                    <i class="material-icons md-36 text-muted">receipt</i>
                  </div>
                  <div class="media-body">
                    <p class="m-a-0">
                      <a href="#">Sam</a> added a new invoice <a href="#">#9591</a>
                    </p>
                    <small class="text-muted">
                      <i class="material-icons md-18">timer</i> <span class="icon-text">5 hrs ago</span>
                    </small>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-left media-middle">
                    <i class="material-icons md-36 text-muted">dns</i>
                  </div>
                  <div class="media-body">
                    <p class="m-a-0">
                      <a href="#">John</a> created a new <a href="#">task</a>
                    </p>
                    <small class="text-muted">
                      <i class="material-icons md-18">today</i> <span class="icon-text">1 day ago</span>
                    </small>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-left media-middle">
                    <i class="material-icons md-36 text-muted">group</i>
                  </div>
                  <div class="media-body">
                    <p class="m-a-0">
                      <a href="#">Partick</a> added <a href="#">Sam</a> are now friends.
                    </p>
                    <small class="text-muted">
                      <i class="material-icons md-18">today</i> <span class="icon-text">2 days ago</span>
                    </small>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="tab-pane active in" id="customers" aria-expanded="true">
            <table class="table  m-b-0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Company</th>
                  <th width="120" class="center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="#"> Derek S.</a></td>
                  <td>Reel Ltd.</td>
                  <td class="text-xs-center">
                    <a href="#" class="btn btn-white btn-sm">
                      <i class="material-icons md-18">edit</i>
                    </a>
                    <a href="#" class="btn btn-white btn-sm">
                      <i class="material-icons md-18">email</i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td><a href="#"> Paul M.</a></td>
                  <td>Places Ltd.</td>
                  <td class="text-xs-center">
                    <a href="#" class="btn btn-white btn-sm">
                      <i class="material-icons md-18">edit</i>
                    </a>
                    <a href="#" class="btn btn-white btn-sm">
                      <i class="material-icons md-18">email</i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td><a href="#"> John D.</a></td>
                  <td>Woot Ltd.</td>
                  <td class="text-xs-center">
                    <a href="#" class="btn btn-white btn-sm">
                      <i class="material-icons md-18">edit</i>
                    </a>
                    <a href="#" class="btn btn-white btn-sm">
                      <i class="material-icons md-18">email</i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td><a href="#">Amy T.</a></td>
                  <td>Scoop Ltd.</td>
                  <td class="text-xs-center">
                    <a href="#" class="btn btn-white btn-sm">
                      <i class="material-icons md-18">edit</i>
                    </a>
                    <a href="#" class="btn btn-white btn-sm">
                      <i class="material-icons md-18">email</i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
      </div>    
      
    </div>
    -->
    <!-- // END Column -->

    <!-- Column -->

    <!-- // END Column -->

    <!-- Column -->
    <!-- 
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-white center">
          <h5 class="card-title">Top Member</h5>
          <p class="card-subtitle m-b-0">Adrian Demian</p>
        </div>
        <table class="table table-sm m-b-0">
          <tbody><tr>
            <td><i class="material-icons text-primary">person</i> <span class="icon-text"><a href="#">Adrian Demian</a></span></td>
            <td class="right">
              <div class="label label-success">49</div>
            </td>
            <td class="right" width="1"><a href="#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
          </tr>
          <tr>
            <td class="text-muted"><i class="material-icons text-muted">person</i> <span class="icon-text">Michelle Smith</span></td>
            <td class="right">
              <div class="label label-default">24</div>
            </td>
            <td class="right" width="1"><a href="#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
          </tr>

          <tr>
            <td class="text-muted"><i class="material-icons text-muted">person</i> <span class="icon-text">Jonny Clint</span></td>
            <td class="right">
              <div class="label label-default">16</div>
            </td>
            <td class="right" width="1"><a href="#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
          </tr>
          <tr>
            <td class="text-muted"><i class="material-icons text-muted">person</i> <span class="icon-text">Andrew Brain</span></td>
            <td class="right">
              <div class="label label-default">13</div>
            </td>
            <td class="right" width="1"><a href="#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
          </tr>
          <tr>
            <td class="text-muted"><i class="material-icons text-muted">person</i> <span class="icon-text">Bill Carter</span></td>
            <td class="right">
              <div class="label label-default">5</div>
            </td>
            <td class="right"><a href="#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
          </tr>
        </tbody></table>
      </div>
    </div>
    -->
    <!-- // END Column -->

  </div>
  <!-- // END Row -->

</div>
@endsection
