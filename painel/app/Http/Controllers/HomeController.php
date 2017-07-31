<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use File;
use App\Banner;
use App\Sobreadbm;
use App\Degustacaodbm;
use App\Professor;
use App\Dbmnumero;
use App\Depoimento;
use App\Contato;
use App\Configuracao;
use App\Empresainfo;
use DB;
use Illuminate\Support\Facades\Mail; //disparador de mesnagens

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
          conteudo dinamico da pagina inicial Home
        */

        //conteudo para mostrar ou esconder botão de comprar
        $videoaula = DB::table('videoaulas')->select('*','videoaulas.id as video_id')
            ->leftJoin('professors', 'professors.id', '=', 'videoaulas.professor_id')
            ->where('category_id', '=',3)
            ->where('status', '=','Ativo')
            ->get();
        $empresaInfo = Empresainfo::all();

        $banners = Banner::all();
        $sobreadbms = Sobreadbm::all();
        $degustacaos = DB::table('degustacaodbms')
            ->join('professors', 'professors.id', '=', 'degustacaodbms.professor_id')
            ->select('degustacaodbms.*', 'professors.nome')
            ->get();
        $dbmnumeros = Dbmnumero::orderBy('id','ASC')->paginate(4);
        //$depoimentos = Depoimento::all();
        $depoimentos = DB::table('reviews')->selectRaw('reviews.id,reviews.review,reviews.coment, reviews.user_id,
        reviews.status, users.id, users.name,alunos.user_id,alunos.img_perfil, alunos.cidade, alunos.estado,alunos.bairro')
                 ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
                 ->leftJoin('alunos', 'alunos.user_id', '=', 'reviews.user_id')
                 ->orderBy('reviews.review', 'DESC')
                 ->get();

        return view('layouts.site.home', compact('banners', 'sobreadbms', 'degustacaos', 'dbmnumeros', 'depoimentos', 'videoaula', 'empresaInfo'));
    }

    public function  list(){
      $banners = Banner::paginate(5);
      $sobreadbms = Sobreadbm::all();
      $totalSobre=0;
      //var_dump($sobreadbms[0]->id);
      if(isset($sobreadbms[0])){
        $totalSobre = 1;
      }
      $professors = Professor::all();

      $degustacaos = Degustacaodbm::all();
      $dbmnumeros = Dbmnumero::all();
      //$depoimentos = Depoimento::all();

      return view('adm.homepage', compact(
                                      'banners', 'sobreadbms',
                                      'totalSobre', 'professors',
                                      'degustacaos', 'dbmnumeros',
                                      'depoimentos'
                                    ));
    }

    public function listContatos(){
      $contatos = Contato::paginate(5);
      $totalContatos = Contato::selectRaw('count(*) as total')->get();
      //dd($totalContatos);
      $totalContatos = $totalContatos[0]->total;
      return view('adm.contatos.list', compact('contatos', 'totalContatos'));
    }

    public function storeDegustar(Request $request){
             $req = $request->all();
             $degustacao = new Degustacaodbm($req);
             //var_dump($req); exit();
             $file = array('image' => Input::file('image'));

             //var_dump($banner->url_imagem);exit();

             if(Input::file('image') != null){
               // setting up rules
               $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
               // doing the validation, passing post data, rules and the messages
               $validator = Validator::make($file, $rules);
               if ($validator->fails()) {
                 // send back to the page with the input data and errors
                 return Redirect::to('adm/homepage')->withInput()->withErrors($validator);
               }
               else {
                 // checking file is valid.
                 if (Input::file('image')->isValid()) {

                   $destinationPath = 'uploads'; // upload path
                   $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                   //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
                   $nameonly=preg_replace('/\..+$/', '', Input::file('image')->getClientOriginalName());
                   $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image
                   Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                 }
               }
             }

             //salvando os dados do banner
             if(Input::file('image') != null){
                 $degustacao->imagem_video = $fileName;
                 $degustacao->url_imagem = $destinationPath."/".$fileName;
             }

             $degustacao->save();

             Session::flash('success', '<div class="alert alert-success">
                                         Cadastrado com sucesso!
                                       </div>');
             //return view('clientes.add');
             return redirect('adm/homepage');
     }
     public function editContatos($id){
       $contatos = Contato::find($id);

       return view('adm.contatos.view', compact('contatos'));
     }

     public function editDegustacao($id){
        $degustacao = Degustacaodbm::find($id);
        $professors = Professor::all();
        return view('adm.degustacao.edit', compact('degustacao', 'professors'));

     }

     public function updateContatos($id, Request $request){

     }

     public function updateDegustacao($id, Request $request){

         $input = $request->all();
         $degustacao = Degustacaodbm::find($id);
         
          $file = array('image' => Input::file('image'));

             //var_dump($banner->url_imagem);exit();

             if(Input::file('image') != null){
               // setting up rules
               $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
               // doing the validation, passing post data, rules and the messages
               $validator = Validator::make($file, $rules);
               if ($validator->fails()) {
                 // send back to the page with the input data and errors
                 return Redirect::to('adm/homepage')->withInput()->withErrors($validator);
               }
               else {
                 // checking file is valid.
                 if (Input::file('image')->isValid()) {

                   $destinationPath = 'uploads'; // upload path
                   $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                   //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
                   $nameonly=preg_replace('/\..+$/', '', Input::file('image')->getClientOriginalName());
                   $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image
                   Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                 }
               }
             }

             //salvando os dados do banner
             if(Input::file('image') != null){
                 $degustacao->imagem_video = $fileName;
                 $degustacao->url_imagem = $destinationPath."/".$fileName;
                 $degustacao->save();
             }
         
         $degustacao->fill($input)->save();

         Session::flash('success', '<div class="alert alert-success">
                                     Atualizado com sucesso!
                                   </div>');


         //return view('adm.banner.edit', compact('banner'));
         return redirect()->back();
     }

     //EDITAR DEPOIMENTOS NO ADM
     public function editDepoimento($id){
        $depoimento = Depoimento::find($id);

        return view('adm.depoimento.edit', compact('depoimento'));

     }
     //ATUALIZAR DEPOIMENTO
     public function updateDepoimento($id, Request $request){

         $input = $request->all();
         $Depoimento = Depoimento::find($id);
         $Depoimento->fill($input)->save();

         Session::flash('success', '<div class="alert alert-success">
                                     Atualizado depoimento com sucesso!
                                   </div>');


         //return view('adm.banner.edit', compact('banner'));
         return redirect('adm/homepage#five');
     }

     //editar DBM Numero
     public function editDbmnumero($id){
       $dbmnumero = Dbmnumero::find($id);

       return view('adm.dbmnumero.edit', compact('dbmnumero'));
     }
     public function updateDbmnumero($id, Request $request){

         $input = $request->all();
         $dbmnumero = Dbmnumero::find($id);
         $dbmnumero->fill($input)->save();

         Session::flash('success', '<div class="alert alert-success">
                                     Atualizado com sucesso!
                                   </div>');


         //return view('adm.banner.edit', compact('banner'));
        return redirect('adm/homepage');
     }

     public function storeDbmnumero(Request $request)
    {
            $req = $request->all();

            $Dbmnumero = new Dbmnumero($req);
            //var_dump($user); exit();

            $Dbmnumero->save();

            Session::flash('success', '<div class="alert alert-success">
                                        Cadastrado número com sucesso!
                                      </div>');
            //return view('clientes.add');
            return redirect('adm/homepage#four');
    }

    public function storeDepoimento(Request $request)
   {
           $req = $request->all();

           $Depoimento = new Depoimento($req);
           //var_dump($user); exit();

           $Depoimento->save();

           Session::flash('success', '<div class="alert alert-success">
                                       Cadastrado depoimento com sucesso!
                                     </div>');
           //return view('clientes.add');
           return redirect('adm/homepage#five');
   }

   public function storeContato(Request $request){
          $req = $request->all();

          $Contato = new Contato($req);
          //var_dump($user); exit();
        

          $Contato->save();
          
          $_POST['email'] = $req['email'];
           $_POST['name'] = $req['name'];
           //enviar email para o cliente
            try {
              Mail::send('layouts.site.contato-email-form', array('Nome'=> $req['name'],'Telefone'=>$req['phone'], 'ConteudoMensagem'=>$req['message'],'Assunto'=>'Preenchido formulário de contato no Portal DBM','firstname'=>"Portal DBM", 'EmailCliente'=> $req['email']), function($message){
                  //So funciona no contexto aqui interno
                  //var_dump($_POST);
                  $mensagem = "Preenchido formulário de contato no Portal DBM";

                  $message->to( ["webmaster@portaldbm.com.br", "contato@portaldbm.com.br"], $_POST['name'] )->subject($mensagem);
              });

              //flash('Mensagem enviada com sucesso!', 'success');


           } catch (Exception $exc) {
               echo $exc->getTraceAsString();
           }

          Session::flash('success', '<div class="alert alert-success">
                                      Cadastrado contato com sucesso!
                                    </div>');
          //return view('clientes.add');
          return redirect('/contato');
  }

  //=== EDITAR DADOS DO PAGSEGURO =============
  public function listConfiguracoes(){
    $configuracoes = Configuracao::all();
    return view('adm/configuracoes/pagseguro', compact('configuracoes'));
  }

  public function editConfiguracoes($id){
		
  }

  public function updateConfiguracoes(){

  }
  
  //ADMINISTRACAO DO RODAPE E INFOS DA EMPRESA
  public function rodapeListEmpresa(){
  	$empresaInfos = Empresainfo::all();
  	return view('adm.configuracoes.rodape', compact('empresaInfos'));  	
  }
  //EDITAR INFORMACOES DO RODAPE
  public function editRodape($id){
  	
  	 $configuracoes = Empresainfo::find($id);
  	 
  	
  	return view('adm/configuracoes/edit-rodape', compact('configuracoes') );
  	
  }
  //ATUALIZAR INFORMACOES DO RODAPE
   public function updateRodape($id, Request $request){

         $input = $request->all();
         $rodape = Empresainfo::find($id);
         $rodape->fill($input)->save();

         Session::flash('success', '<div class="alert alert-success">
                                     Atualizado com sucesso!
                                   </div>');


         //return view('adm.banner.edit', compact('banner'));
        return redirect('adm/configuracoes/rodape');
     }
  

     public function destroyDegustacao($id)
     {
       Degustacaodbm::findOrFail($id)->delete();

       Session::flash('success', '<div class="alert alert-success">
                                   Apagado com sucesso!
                                 </div>');

       return redirect('adm/homepage');
     }
     public function destroyDbmnumero($id)
     {
       Dbmnumero::findOrFail($id)->delete();

       Session::flash('success', '<div class="alert alert-success">
                                   Apagado com sucesso!
                                 </div>');

       return redirect('adm/homepage');
     }

     //apagar depoimento
     public function destroyDepoimento($id)
     {
       Depoimento::findOrFail($id)->delete();

       Session::flash('success', '<div class="alert alert-success">
                                   Depoiemnto apagado com sucesso!
                                 </div>');

       return redirect('adm/homepage');
     }

}
