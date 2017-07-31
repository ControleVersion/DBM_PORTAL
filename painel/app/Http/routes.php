<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
	//CONTEUDO ACESSIVEL EM TODAS AS TELAS ==========================================
	$videoaula = \DB::table('videoaulas')->select('*','videoaulas.id as video_id')
			->leftJoin('professors', 'professors.id', '=', 'videoaulas.professor_id')
			->where('category_id', '=',3)
			->where('status', '=','Ativo')
			->get();
	//TOTAL DE PEDIDOS PAGOS
	$pedidospagos = \DB::table('pagseguro_log')->where('status', '=', 'Paga')
					->groupBy('transaction_id')
                 	->get();
    //criando conteudo de total de pedidos feitos
	Session::set('pedidospagos', $pedidospagos);

	//criando conteudo para ser exibido em todas as telas
	Session::set('videoaula', $videoaula);

	$empresaInfo = App\Empresainfo::all();
	//criando conteudo para ser exibido em todas as telas
	Session::set('empresaInfo', $empresaInfo);

Route::get('/',function(){



			$banners = App\Banner::all();

			$sobreadbms  = App\Sobreadbm::all();

			$degustacaos = DB::table('degustacaodbms')
					->join('professors', 'professors.id', '=', 'degustacaodbms.professor_id')
					->select('degustacaodbms.*', 'professors.nome')
					->get();

			$dbmnumeros = App\Dbmnumero::orderBy('id','ASC')->paginate(4);
			//$depoimentos = Depoimento::all();

			$depoimentos = DB::table('reviews')->selectRaw('reviews.id,reviews.review,reviews.coment, reviews.user_id,
			reviews.status, users.id, users.name,alunos.user_id,alunos.img_perfil, alunos.cidade, alunos.estado,alunos.bairro')
							 ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
							 ->leftJoin('alunos', 'alunos.user_id', '=', 'reviews.user_id')
							 ->orderBy('reviews.review', 'DESC')
							 ->get();

			return view('layouts.site.home', compact('banners', 'sobreadbms', 'degustacaos', 'dbmnumeros', 'depoimentos', 'videoaula', 'empresaInfo'));
	});


/*
	TRATAMENTO PUBLICO PARA FUNCIONAMENTO DO RECAPCHA DA GOOLE
	REFERENCES: https://github.com/anhskohbo/no-captcha
*/
Route::get('site-register', 'Auth\AuthController@siteRegister');
Route::post('register', 'Auth\AuthController@siteRegisterPost');

Route::get('/home', 'HomeController@index');
Route::get('/sucesso', function(){


	return view('sucesso');
});

//teste de retorno de pagamento no PagSeguro
Route::post('return-pagamento',['uses'=>'VideoaulasController@retornaPagamento','as'=>'carrinho.checkout']);
Route::get('comprar', ['uses'=>'VideoaulasController@verCarrinho']);

//dbmicos - mapa
Route::get('dbmicos', function(){
	return view('layouts.site.dbmicos');
});


//pagina O Curso
Route::get('dbm-curso', ['uses'=>'DbmcursosController@index','as'=>'dbmcursos.index']);

//pagina de Profissionais
Route::get('profissionais', ['uses'=>'ProfissionaisController@index','as'=>'profissionais.index']);
//ajax do menu de profissionais
Route::get('get-menu-profissionais', function(){
	$profissionais = App\Profissional::all();
	$htmlMenu ='';
	foreach($profissionais as $profi){
		$htmlMenu .= '<li>
										<a href="'.url('profissionais').'#'.$profi->id.'"> '.$profi->nome.' </a>
									</li>';
	}
	echo  $htmlMenu;
});

Route::get('teste-cadastro/{email?}', function($email){
	//teste de retorno de lista de alunos
	$listaAluno = DB::table('lista_de_alunos')->where('email', '=', $email)->get();
    if(count($listaAluno) > 0){
    	return "Email Cadastrado";
    } else{
    	echo '<script type="text/javascript">alert("Cadastro negado, favor entrar em contato com \n contato@portaldbm.com.br");</script>';
    	return redirect('/contato');
    }
});

//pagina de Galerias
Route::get('galeria', ['uses'=>'GaleriasController@index','as'=>'galerias.index']);
//visualizar todas as imagens da galeria
Route::get('galeria/view/{id?}', ['uses'=>'GaleriasController@listarImagens','as'=>'galerias.ver']);

//pagina de Contatos
Route::get('contato', function(){

	return view('layouts.site.contato');
});
Route::post('contato/store', ['uses'=>'HomeController@storeContato', 'as'=>'contato.store']);

//pagina de registro para conteudo gratuito
Route::get('registro', function ()    {


	return view('layouts.site.registro');
});
Route::get('confirmar', function ()    {


	//return view('layouts.site.registro');
	return view('layouts.site.confirmar');
});

Route::get('confirmar-pagamento', ['uses'=>'VideoaulasController@getTrasactionURL']);
Route::post('confirmar-pagamentos', ['uses'=>'VideoaulasController@notificationURL']);

/*
	registrar avaliacoes, reviews
*/
//Route::get('register-review/{id?}', ['uses'=> 'ReviewsController@create']);
Route::post('register-review/{id?}', ['uses'=> 'ReviewsController@create']);

Route::get('autorizar', function ()    {

	$retorno = "";
	if(isset($_GET['id'])){
		//tratamento para ativar o usuario por email
		$idUser = base64_decode($_GET['id']);
		$aluno = \DB::table("alunos")->where( 'user_id','=',$idUser)->get();
		if(count($aluno) > 0){
			$status = $aluno[0]->status;
			//modificar status
			if($status == "Inativo"){
				//mudando status do aluno para ativo
				\DB::update("update alunos set status ='Ativo'  where user_id = ?", [$idUser]);
				$retorno = "Ativado";

				//var_dump("Ativado");
			}else {
				//var_dump("Usuário já ativado...");
				$retorno = "Redirecionar";
			}
		}
	}

	//return view('layouts.site.registro');
	return view('layouts.site.confirmar', compact('retorno'));
});


Route::group(['middleware' => 'auth'], function () {


		/*
      ROTAS DA ADMINISTRACAO DO SITE
    */
    Route::group(['prefix' => 'adm'], function () {

        Route::get('dashboard', function ()    {

          return view('adm.dashboard');
        });
        Route::get('/list', ['uses'=>'HomeController@list']);
				Route::get('/homepage', ['uses'=>'HomeController@list']);

        //edicao de banners da home
         Route::get('banner/edit/{id?}', ['as'=>'banner.edit', 'uses'=>'BannersController@edit']);
         Route::put('banner/update/{id}', ['as'=> 'banner.update', 'uses'=>'BannersController@update']);
         Route::get('banner/destroy/{id}', ['as' => 'banner.destroy', 'uses'=>'BannersController@destroy']);

         //add sobre a DBM
         Route::post('sobre/store', ['uses'=>'SobreadbmsController@store', 'as'=>'sobre.store']);
				 //editar Sobre a DBM da Home
				Route::put('sobre/update/{id}', ['uses'=>'SobreadbmsController@update', 'as'=>'sobre.update']);
				Route::get('sobre/edit/{id?}', ['uses'=>'SobreadbmsController@edit', 'as'=>'sobre.edit']);

				//administrar configuracoes PagSeguro
					//editar configuracoes PagSeguro
					Route::get('pagseguro/list', ['uses'=>'HomeController@listConfiguracoes']);
				 Route::put('pagseguro/update/{id}', ['uses'=>'HomeController@updateConfiguracoes', 'as'=>'pagseguro.update']);
				 Route::get('pagseguro/edit/{id?}', ['uses'=>'HomeController@editConfiguracoes', 'as'=>'pagseguro.edit']);

				 //EDITAR CONFIGURACOES E INFORMACOES DA EMPRESA E RODAPE
				 Route::get('configuracoes/rodape',['uses'=>'HomeController@rodapeListEmpresa']);
				 Route::get('configuracoes/editRodape/{id}', ['uses'=>'HomeController@editRodape']);
				 Route::put('configuracoes/update/{id}', ['as'=>"configuracoes.update",'uses'=>'HomeController@updateRodape']);

				 //DEGUSTACAO DBM
				 Route::get('degustacao/edit/{id?}', ['uses'=>'HomeController@editDegustacao', 'as'=>'degustacao.edit']);
				 Route::put('degustacao/update/{id}', ['as'=> 'degustacao.update', 'uses'=>'HomeController@updateDegustacao']);
				 Route::post('degustacao/store', ['uses'=>'HomeController@storeDegustar', 'as'=>'degustacao.store']);
				 Route::get('degustacao/destroy/{id}', ['as' => 'degustacao.destroy', 'uses'=>'HomeController@destroyDegustacao']);

				 //DBM EM NUMEROS
				 //adicionar novo
				 Route::post('dbmnumeros/store', ['uses'=>'HomeController@storeDbmnumero', 'as'=>'dbmnumeros.store']);
				 Route::get('dbmnumero/destroy/{id}', ['as' => 'dbmnumero.destroy', 'uses'=>'HomeController@destroyDbmnumero']);
				 Route::get('dbmnumero/edit/{id}', ['uses'=>'HomeController@editDbmnumero', 'as'=>'dbmnumero.edit']);
				 Route::put('dbmnumero/update/{id}', ['as'=>"dbmnumeros.update", 'uses'=>'HomeController@updateDbmnumero']);

				 //DEPOIMENTOS DOS ALUNOS NA HOME
				 Route::post('depoimentos/store', ['uses'=>'HomeController@storeDepoimento','as'=>'depoimentos.store']);
				 Route::get('depoimentos/edit/{id?}', ['uses'=>'HomeController@editDepoimento', 'as'=>'depoimentos.edit']);
				 Route::put('depoimentos/update/{id}', ['as'=> 'depoimentos.update', 'uses'=>'HomeController@updateDepoimento']);
				 Route::get('depoimentos/destroy/{id}', ['as' => 'depoimentos.destroy', 'uses'=>'HomeController@destroyDepoimento']);


				 //PROFISSIONAIS NA HOME
				 Route::get('profissionais', ['uses'=>'ProfissionaisController@listar','as'=>'profissionais.listar']);
				 Route::post('profissionais/store', ['uses'=>'ProfissionaisController@store','as'=>'profissionais.store']);
				 Route::get('profissionais/edit/{id?}', ['uses'=>'ProfissionaisController@edit', 'as'=>'profissionais.edit']);
				 Route::put('profissionais/update/{id}', ['as'=> 'profissionais.update', 'uses'=>'ProfissionaisController@update']);
				 Route::get('profissionais/destroy/{id}', ['as' => 'profissionais.destroy', 'uses'=>'ProfissionaisController@destroy']);

				 //GALERIAS NA HOME
				 Route::get('galerias', ['uses'=>'GaleriasController@listar','as'=>'galerias.listar']);
				 Route::post('galerias/store', ['uses'=>'GaleriasController@store','as'=>'galerias.store']);
				 Route::get('galerias/edit/{id?}', ['uses'=>'GaleriasController@edit', 'as'=>'galerias.edit']);
				 Route::put('galerias/update/{id}', ['as'=> 'galerias.update', 'uses'=>'GaleriasController@update']);
				 Route::get('galerias/destroy/{id}', ['as' => 'galerias.destroy', 'uses'=>'GaleriasController@destroy']);
				 //== multiupload de fotos
				 Route::post('galerias/ajax-multiupload', ['uses'=>'GaleriasController@ajaxMultiUpload']);
				 Route::get('galerias/get-multi-images/{id?}', ['uses'=>'GaleriasController@getMultiImagesGalery']);
				 Route::post('galerias/destroy-item-galery/{id?}', ['uses'=>'GaleriasController@destroyImageGalery']);

				 //GALERIAS NA HOME
				 Route::get('dbmcurso', ['uses'=>'DbmcursosController@listar','as'=>'dbmcursos.listar']);
				 Route::post('dbmcurso/store', ['uses'=>'DbmcursosController@store','as'=>'dbmcursos.store']);
				 Route::get('dbmcurso/edit/{id?}', ['uses'=>'DbmcursosController@edit', 'as'=>'dbmcursos.edit']);
				 Route::put('dbmcurso/update/{id}', ['as'=> 'dbmcursos.update', 'uses'=>'DbmcursosController@update']);
				 Route::get('dbmcurso/destroy/{id}', ['as' => 'dbmcursos.destroy', 'uses'=>'DbmcursosController@destroy']);

				 //CATEGORIAS
				 Route::get('categories', ['uses'=>'CategoriesController@listar','as'=>'categories.index']);
				 Route::post('categories/store', ['uses'=>'CategoriesController@store','as'=>'categories.store']);
				 Route::get('categories/edit/{id?}', ['uses'=>'CategoriesController@edit', 'as'=>'categories.edit']);
				 Route::put('categories/update/{id}', ['as'=> 'categories.update', 'uses'=>'CategoriesController@update']);
				 Route::get('categories/destroy/{id}', ['as' => 'categories.destroy', 'uses'=>'CategoriesController@destroy']);

				 //VIDEOAULAS
				Route::get('videoaulas/listar', ['uses'=>'VideoaulasController@listar','as'=>'videoaulas.index']);
				Route::post('videoaulas/store', ['uses'=>'VideoaulasController@store','as'=>'videoaulas.store']);
				Route::get('videoaulas/edit/{id?}', ['uses'=>'VideoaulasController@edit', 'as'=>'videoaulas.edit']);
				Route::put('videoaulas/update/{id}', ['as'=> 'videoaulas.update', 'uses'=>'VideoaulasController@update']);
				Route::get('videoaulas/destroy/{id}', ['as' => 'videoaulas.destroy', 'uses'=>'VideoaulasController@destroy']);
				//LISTAR CONTEUDO PRESENCIAL
				Route::get('videoaulas/conteudo-presencial',['uses'=>'VideoaulasController@listarConteudoPresencial']);

				//PROFESSORES
			 Route::get('professors', ['uses'=>'ProfessorsController@index','as'=>'professors.index']);
			 Route::post('professors/store', ['uses'=>'ProfessorsController@store','as'=>'professors.store']);
			 Route::get('professors/edit/{id?}', ['uses'=>'ProfessorsController@edit', 'as'=>'professors.edit']);
			 Route::put('professors/update/{id}', ['as'=> 'professors.update', 'uses'=>'ProfessorsController@update']);
			 Route::get('professors/destroy/{id}', ['as' => 'professors.destroy', 'uses'=>'ProfessorsController@destroy']);

			 //PROFESSORES
			Route::get('users', ['as'=>'users.index', 'uses'=>'UsersController@index']);

			Route::post('users/store', ['uses'=>'UsersController@store','as'=>'users.store']);
			Route::get('users/view/{id?}', ['uses'=>'UsersController@edit', 'as'=>'users.edit']);

			Route::get('users/destroy/{id}', ['as' => 'users.destroy', 'uses'=>'UsersController@destroy']);

				//contatos
				Route::get('contatos',['uses'=>'HomeController@listContatos']);
				Route::get('contatos/view/{id?}', ['uses'=>'HomeController@editContatos', 'as'=>'contatos.edit']);
				Route::put('contatos/update/{id}', ['as'=> 'contatos.update', 'uses'=>'HomeController@updateContatos']);


				//Reviews Avaliacoes dos Alunos
				Route::get('reviews/listar',['uses'=>'ReviewsController@index']);
				Route::get('reviews/edit/{id?}', ['uses'=>'ReviewsController@edit', 'as'=>'reviews.edit']);
			 	Route::put('reviews/update/{id}', ['as'=> 'reviews.update', 'uses'=>'ReviewsController@update']);

				 //EDITAR PERFIL DE DADOS DO ADMINISTRADOR
	 			Route::get('/perfil/{id?}',  ['as' => 'adm.users.editperfil', 'uses'=>'UsersController@editPerfilAdm']);
	 			Route::put('pefil/update/{id}', ['as'=> 'adm.users.uperfil', 'uses'=>'UsersController@updatePerfil']);

				//ADMINISTRAR ALUNOS PRESENCIAIS
				Route::get('presenciais/listar', ['uses'=>'UsersController@listPresenciais']);
				Route::get('convidar-aluno', ['uses'=>'UsersController@convidarAluno']);
				Route::post('convidar/store', ['uses'=>'UsersController@storeConvidar','as'=>'convidar.store']);
    });

		//area restrita do aluno no frontend
		Route::group(['prefix'=>'area-aluno'], function(){
			Route::get('/videos', ['as'=>'videos.index', 'uses'=>'VideoaulasController@index']);
			Route::get('/cursos', ['uses'=>'VideoaulasController@listarCursos']);
			Route::get('coneudo-presencial', ['uses'=>'VideoaulasController@listarCursosPresenciais']);
			Route::get('/videos/ver/{id?}', ['as'=>'videos.ver-video','uses'=>'VideoaulasController@verVideo']);
			//EDITAR PERFIL DE DADOS DO ALUNO
			Route::get('/perfil/{id?}',  ['as' => 'users.editperfil', 'uses'=>'UsersController@editPerfil']);
			Route::put('pefil/update/{id}', ['as'=> 'users.uperfil', 'uses'=>'UsersController@updatePerfil']);

			Route::put('pefil/atualizar/{id}', ['as'=> 'users.update', 'uses'=>'UsersController@update']);

			Route::get('/', function(){
				return view('layouts.site.area-aluno.default');
			});
			Route::get('/material', function(){
				return view('layouts.site.area-aluno.material');
			});

			//CARREGAR DADOS DA COMPRA NO PAGSEGURO
			Route::get('getpagamentobycode/{code?}', ['uses'=>'VideoaulasController@getInformacoesPagseguroByCode']);

		});
});

//4c76a948ed
Route::post('/subscribe', function(){
	/*
		Install pacote MailChimp
		#composer  => https://github.com/nztim/mailchimp
		 php ../composer.phar require nztim/mailchimp
	*/
	header('Content-Type: application/json');
	$idLista = '4c76a948ed';
	$emailCadastro = request()->input('email');
	$resposta = ['retorno'=>''];
	if(count($emailCadastro) > 0){
		if(Mailchimp::check($idLista, $emailCadastro)){
			$resposta = ['retorno'=>'falha'];
			return json_encode($resposta);
		} else {


			Mailchimp::subscribe(
				$idLista, //ID DA LISTA CRIADA NO MAILCHIMP
				$emailCadastro,
				[],  //dados adicionais do inscrito
				false  //ou true se quiser que seja confirmado
			);

			$resposta = ['retorno'=>'sucesso'];

			return json_encode($resposta);
		}
	}
});

    /*
			UPLOADS DE ARQUIVOS PARA O BANNER
		*/
		Route::get('/upload', function() {
		  return view('menu.index');
		});
		Route::post('apply/upload', ['uses'=>'ApplyController@upload', 'as'=>'apply.upload']);

Route::auth();
