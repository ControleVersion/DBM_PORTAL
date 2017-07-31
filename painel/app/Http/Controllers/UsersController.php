<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Aluno;
use App\ListaAluno;
use App\User;
use Session;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use File;
use Auth;
use DB;
//PARA FUNCIONAR PAGINACAO NO OBJETO DB
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail; //disparador de mesnagens

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('adm.users.index', compact('users'));
    }

    public function listPresenciais(Request $request){
      /*
      User::raw('*')->leftJoin('alunos', 'alunos.user_id', '=', 'users.id')
                ->leftJoin('alunos', 'alunos.plano_acesso','=','Presencial')
                ->paginate(5);
      */
      $users = DB::select(DB::raw("SELECT users.id,users.name, users.email, users.type,
                alunos.plano_acesso, alunos.user_id
                FROM  `users`
                INNER JOIN alunos ON alunos.user_id=users.id
                AND alunos.plano_acesso='Presencial'
                ORDER BY users.id DESC"));
      //FORCAR PAGINACAO DE OBJETO PERSONALIZADO DB
      //NAO ESQUECER DE INCLUIR IMPORTACOES NO TOPO
      $notices = $this->arrayPaginator($users, $request);
      return view('adm.users.presenciais-list')->with('users', $notices);
      //return view('adm.users.presenciais-list', compact('users'));
    }
    public function arrayPaginator($array, $request){
        $page = Input::get('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }
    public function convidarAluno(){
    	
    	$listadealunos = ListaAluno::all();	
      	return view('adm.users.convite-aluno', compact('listadealunos') );
    }
    //== ENVIAR CONVITE PARA ACESSO DE CONTEUDO PRESENCIAL =====
    public function storeConvidar(Request $request){
           $req = $request->all();
			
			$emailAluno;
			$nomeAluno;
			for($x=0; $x < count($req['email']); $x++){
				
				$alunolista = DB::table('lista_de_alunos')->where('id','=',$req['email'][$x])->get();
				
				//variaveis externa para envio
				$emailAluno = $alunolista[0]->email;	
				$nomeAluno = $alunolista[0]->nome;
				//variaveis internas globais
				$_POST['email'] = $emailAluno;
           		$_POST['name'] = $nomeAluno;
           		
           		//intervalo 2 segundos para nao compromoter o servidor
           		sleep(2);
           		
           		//enviar email para o cliente
            	try {
              		Mail::send('layouts.site.evento-presencial-email', array('Nome'=> $nomeAluno,'Assunto'=>'Conteúdo do Curso Presencial - Portal DBM','firstname'=>"Portal DBM", 'EmailCliente'=> $emailAluno), function($message){
                  		//So funciona no contexto aqui interno
                  			$mensagem = "Assista nosso conteúdo Exclusivo no Portal DBM";

                  		$message->to( [$_POST['email'],"webmaster@portaldbm.com.br"], $_POST['name'] )->subject($mensagem);
              		});
					//ataualizar status de envio
              		DB::table('lista_de_alunos')->where('id','=',$req['email'][$x])
            						->update(['status' => 'Enviado']);

           		} catch (Exception $exc) {
              		 echo $exc->getTraceAsString();
           		}			
			}

           

           Session::flash('success', '<div class="alert alert-success">
                                       Convite enviado com sucesso!
                                     </div>');
           //return view('clientes.add');
           return redirect('adm/presenciais/listar');
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         $alunos = Aluno::where('user_id','=',$id)->get();
         $user = User::findOrFail($id);

         return view('adm.users.view', compact('alunos', 'user'));
     }

    public function editPerfil($id)
    {
        $alunos = Aluno::where('user_id','=',$id)->get();
        $user = User::findOrFail($id);
        /*
          CRIAR LISTA BASEADA NA TABELA DE LOG DO PAGSEGURO

          --query que lista todas as operacoes realizadas nao repetidas no log
        */
        $userEmail = Auth::user()->email;
        $faturas = DB::select(DB::raw("SELECT DISTINCT transaction_id,resposta_xml,
        status,DATE_FORMAT(created_at,'%d/%m/%Y') as created_at FROM  `pagseguro_log`
        WHERE  `resposta_xml` LIKE  '%".$userEmail."%' AND status != ''
        GROUP BY transaction_id
        ORDER BY id DESC limit 6"));

        //forcando passar somente o codigo de transaction_id atrelado ao xml de resposta
        for($x=0; $x < count($faturas); $x++){
          $resposta_xml = json_decode($faturas[$x]->resposta_xml);
          $resposta_xml = $resposta_xml->code;
          $faturas[$x]->transaction_id = $resposta_xml;
        }
        //var_dump($faturas[4]->retorno);exit();

        return view('layouts.site.area-aluno.perfil', compact('alunos', 'user', 'faturas'));
    }

    public function updatePerfil(Request $request, $id){


      $file = array('image' => Input::file('image'));

        if(Input::file('image') != null){


          // setting up rules
          $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
          // doing the validation, passing post data, rules and the messages
          $validator = Validator::make($file, $rules);
          if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('area-aluno/perfil/edit/'.$id)->withInput()->withErrors($validator);
          }
          else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
              //apagando imagem anterior cadastrada
               if(isset($aluno->img_perfil)){
                   //apagar arquvivo pelo caminho
                   File::delete( $aluno->url_imagem);
               }

              $destinationPath = 'uploads'; // upload path
              $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
              //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
              $nameonly=preg_replace('/\..+$/', '', Input::file('image')->getClientOriginalName());

              $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image
              /*
              $dadosArchive =['menu_pai'=> "", 'menu_name'=> "", 'archive_name'=> "", 'url_archive'=>"", 'user_id'=>0, 'company_id'=>0];

              $dadosArchive = [
                  'imagem_destaque'=>$fileName,
                  'url_imagem'=> $destinationPath."/".$fileName,
                  'titulo_destaque' => $_POST['titulo_destaque'],
                  'subtitulo' => $_POST['subtitulo'],
                  'texto_link' => $_POST['texto_link'],
                  'link_botao' => $_POST['link_botao']
              ];

              //dd($dadosArchive);
              //exit();
              //gravar antes de mover o arquivo
              if($dadosArchive['url_imagem'] != '' && $dadosArchive['titulo_destaque'] != '' && $dadosArchive['subtitulo'] != ""){
                $reqArquive = new Banner($dadosArchive);
                $reqArquive->save();
              }
              */

              Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            }
          }
        }

        //salvando os dados do ALUNO
      	$aluno = Aluno::findOrFail($request['aluno_id']);
        if(Input::file('image') != null){

            $aluno->img_perfil = $destinationPath."/".$fileName;

        }

      $input = $request->all();
      //limpando os caracteres inuteis do cpf
      $vowels = array(".", "-");
      $input['cpf'] = trim(str_replace($vowels, "",$input['cpf']));
      $aluno->fill($input)->save();

      Session::flash('success', '<div class="alert alert-success">
                                  <h5>Atualizado Dados Pessoais com sucesso!</h5>
                                </div>');


      //return view('adm.banner.edit', compact('banner'));
      return redirect()->back();
    }

    /*
      editar User adm
    */
    public function editPerfilAdm($id){

      $user = User::findOrFail($id);

      return view('adm.perfil', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //salvando os dados do banner
      $user = User::findOrFail($id);

      $input = $request->all();
      $input['password'] =  bcrypt($input['password']);
      $user->fill($input)->save();

      Session::flash('success', '<div class="alert alert-success">
                                  <h5>Senha atualizada com sucesso!</h5>
                                </div>');


      //return view('adm.banner.edit', compact('banner'));
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
