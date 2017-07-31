
<div style="padding: 10px;">
  <img width="276" height="140" src="{{url('/')}}/site/images/logo-header-250x150.png">
</div>
<hr style="height: 10px; background-color: #1072c0;">
<h3>Redefinição de Senha</h3>
<p>Você acaba de solicitar a redefinição de sua senha em nosso portal.  Segue abaixo o link para fazê-lo:</p>
<br>

Clique no link para cadastrar uma nova senha no sistema:<br> <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
