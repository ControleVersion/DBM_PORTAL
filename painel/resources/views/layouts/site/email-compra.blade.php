<!-- não sei se ira precisar dessa meta tag  -->
<meta charset="utf-8">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="700px" style="border-collapse: collapse; font-family: Helvetica,Arial,sans-serif;box-shadow:1px 1px 5px #ccc">
	<tr>
		<td bgcolor="#1e72b9" height="100px" style="padding-left:20px;"">
		<a href="http://www.portaldbm.com.br">
		<img src="{{asset('/')}}site/images/DBM-logo-white.png" width="140" height="70" alt="DBM logo"></a>
			
		</td>
	</tr>
	<tr bgcolor="#fff">
		<td style="padding-top:40px; padding-bottom:40px; padding-left:20px;">
			<h2 style="font-size:30px; padding-bottom:10px;">Agradecemos seu interesse nos treinamentos do Portal DBM</h2>
			<br>
			<p style="font-size:20px;">Seja bem vindo, <span id="nomeUsario" style="color:#1e72b9;">{{$NomeAluno}}</span> !!!</p	>
			<br>
			<span>Acesse o seu curso com o seguinte usuário e senha (temporária), abaixo:</span>
			<br>
			<p style="font-size:20px;">
				<b>Usuário:</b> {{$EmailAluno}} <br>
				<b>Senha:</b> {{$SenhaTemporaria}} <br>
				
			</p>
			<a href="{{asset('/registro')}}" id="btnConDBM2017" style="display:block;margin-top:20px;padding:20px; background-color:#039BE5; width:200px;border-radius:10px; text-align: center; color:#fff; font-weight:bold; text-decoration:none;" target="_blank">Acesso ao Curso</a>
			<p>
				** Caso tenha mudado sua senha e esqueceu-se, recupere neste link: <a href="{{asset('password/reset')}}" alt="Recriar senha" target="_blank">RECRIAR SENHA</a>
			</p>
		</td>
	</tr>
	<tr>
		<td bgcolor="#1e72b9" height="45px" style="padding-left:20px; font-size:12px;text-align:center;">
			<p  style="color:#ffffff;"">Você recebeu este e-mail porque se cadastrou no <a href="http://www.portaldbm.com.br" style="color:#ccc; text-decoration:none;">portalDBM.com.br</a>
			<br>	
			Caso não tenha realizado o cadastro desconsidere essa mensagem.</p>
		</td>
	</tr>
</table>
