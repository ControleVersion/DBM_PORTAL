var recuperaEmailDegust = function(){
	//este valor será passado para a página de cadastro
	var email = $('#degustSubscribeDegust').val();
	document.cookie = "useremail=" + email;

	// redireciona para a página de cadastro
	window.location.href = "acesso.html#undefined2";
}