@extends('layouts.login')

@section('content')
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
<div class="col-sm-10 col-sm-push-1 col-md-6 col-md-push-3 col-lg-6 col-lg-push-3">
  <a alt="Home" title="Home" href="{{ url('/') }}">
    <h2 class="text-primary center m-a-2">
      <i class="material-icons md-36">control_point</i> <span class="icon-text">Admin DBM</span>
    </h2>
  </a>
  <div class="card-group">
    <div class="card bg-transparent">
      <div class="card-block">
        <div class="center">
          <h4 class="m-b-0"><span class="icon-text">Login</span></h4>
          <p class="text-muted">Acesso a sua conta</p>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}


          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail </label>

              <div class="col-md-6" style="width: 301px;">
                  <input id="email" type="email" style="width: 301px;" maxlength="80" class="form-control" name="email" value="{{ old('email') }}">

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Senha</label>

              <div class="col-md-6" style="width: 301px;">
                  <input id="password" style="width: 301px;" maxlength="20" type="password" class="form-control" name="password">

                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group" style="margin-top: 10px;">
              <div class="col-md-6 col-md-offset-4" style="margin-top: 10px;">
                {!! captcha_image_html('LoginCaptcha') !!}
                  <input type="text" id="CaptchaCode" class="string email optional form-control" name="CaptchaCode" style="width: 100%;margin-top: 4px; margin-bottom: 9px;" required>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="remember"> Lembrar-me
                      </label>
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-6 col-md-offset-4"  style="margin-bottom: 50px;margin-top: 50px;">
                  <button type="submit" class="btn  btn-primary-outline btn-circle-large">
                      <i class="material-icons">lock</i>
                  </button>

                  <a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueceu a senha?</a>
              </div>
          </div>
          <!--
          <div class="center">
            <button type="submit" class="btn  btn-primary-outline btn-circle-large">
              <i class="material-icons">lock</i>
            </button>
          </div>
          -->
        </form>
      </div>
    </div>

    <!--
    <div class="card">
      <div class="card-block center">
        <h4 class="m-b-0">
          <i class="material-icons">person_add</i> <span class="icon-text">Sign Up</span>
        </h4>
        <p class="text-muted">Create a new account</p>
        <form action="index.html" method="get">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Full Name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm Password">
          </div>
          <button type="submit" class="btn btn-primary btn-rounded">Register</button>
        </form>
      </div>
    </div>
    -->

  </div>

<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Lembrar-me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueceu a senha?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@endsection
