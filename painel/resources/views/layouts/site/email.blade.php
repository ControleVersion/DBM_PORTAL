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
			<h2 style="font-size:30px; padding-bottom:10px;">Obrigado por cadastrar-se no Portal DBM</h2>
			<br>
			<p style="font-size:20px;">Seja bem vindo, <span id="nomeUsario" style="color:#1e72b9;">{{$Nome}}</span> !!!</p	>
			<br>
			<span>Confirme seu e-mail para ter acesso ao nosso conteúdo.</span>
			<br>
			
			<a href="{{$Mensagem}}" id="btnConDBM2017" style="display:block;margin-top:20px;padding:20px; background-color:#039BE5; width:200px;border-radius:10px; text-align: center; color:#fff; font-weight:bold; text-decoration:none;">Ativar conta</a>
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
