<!-- não sei se ira precisar dessa meta tag  -->
<meta charset="utf-8">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="700px" style="border-collapse: collapse; font-family: Helvetica,Arial,sans-serif;box-shadow:1px 1px 5px #ccc">
	<tr>
		<td bgcolor="#1e72b9" height="100px" style="padding-left:20px;"">
		<a href="{{asset('/')}}">
		<img src="{{asset('/')}}site/images/DBM-logo-white.png" width="140" height="70" alt="DBM logo"></a>

		</td>
	</tr>
	<tr bgcolor="#fff">
		<td style="padding-top:40px; padding-bottom:40px; padding-left:20px;">
			<h2 style="font-size:25px; padding-bottom:10px;">Preenchido Formulário de Contato do Portal DBM.</h2>
			<br>
			<p style="font-size:20px;">
        Conteudo da Mensagem enviada:<hr>

        <b>Nome:</b> {{$Nome}}<br>
        <b>Email:</b> {{$EmailCliente}}<br>
        <b>Telefone:</b> {{$Telefone}}<br>
        <b>Conteúdo da Mensagem:</b> {{$ConteudoMensagem}}<br>

      </p	>
			<br>
		</td>
	</tr>
	<tr>
		<td bgcolor="#1e72b9" height="45px" style="padding-left:20px; font-size:12px;text-align:center;">
			<p  style="color:#ffffff;"">Email automático disparado pelo portal <a href="{{asset('/')}}" style="color:#ccc; text-decoration:none;">portalDBM.com.br</a>
			<br>
			Não precisa responder este email, uma cópia foi gravada no sistema administrativo.</p>
		</td>
	</tr>
</table>
