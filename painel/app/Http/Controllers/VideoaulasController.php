<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use Validator;
use Redirect;
use File;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Videoaula;
use App\Professor;
use App\Category;
use App\Aluno;
use App\User;
use App\Configuracao;

use Illuminate\Support\Facades\Mail; //disparador de mesnagens

class VideoaulasController extends Controller
{

    public $emailPagseguro;
    public $tokenPgaseguro;

    /*
      CRIAR DEPOIS NO ADM, VISAO DAS 12 ULTIMAS TRASACOES ATRAVES DESTE LINK DA API:
      https://ws.pagseguro.uol.com.br/v2/transactions?initialDate=2017-05-14T00:00&finalDate=2017-06-14T15:00&page=1&resultsInThisPage=50&maxPageResults=100&email=mvpnutricaosuporte@hotmail.com&token=9EAE1FC931A94823BF7AB99C57F347CC
    */
    public function __construct(){
        $configuracao = Configuracao::all();

        //definando como padrao as configuracoes salvas no ADM do PagSeguro
        $this->emailPagseguro = $configuracao[0]->pagseguro_email;
        $this->tokenPgaseguro = $configuracao[0]->pagseguro_token;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //visao publica para Aluno
    public function index()
    {
        //$videoaulas = Videoaula::all();
        //resgatando o usuario online


        $videoaulas = DB::table('videoaulas')
            ->leftJoin('professors', 'professors.id', '=', 'videoaulas.professor_id')
            ->where('category_id', '=',1)
            ->where('status', '=','Ativo')
            ->get();
        //dd($videoaulas);

        return view('layouts.site.area-aluno.videos', compact('videoaulas'));
    }
    public function listarCursos()
    {
        $idUser = \Auth::user()->id;
        $aluno = DB::table('alunos')
            ->where('user_id', '=',$idUser)
            ->get();

         $videoaulas = DB::table('videoaulas')->select(DB::raw('videoaulas.*,professors.id, professors.nome, professors.foto_perfil, videoaulas.created_at as datacriacao'))
            ->leftJoin('professors', 'professors.id', '=', 'videoaulas.professor_id')
            ->where('videoaulas.category_id', '=',3)
            ->where('videoaulas.status', '=','Ativo')
            ->get();
        //dd($videoaulas);

        return view('layouts.site.area-aluno.cursos', compact('videoaulas', 'aluno'));
    }

    //visao aluno online
    public function listarCursosPresenciais()
    {
        $idUser = \Auth::user()->id;
        $aluno = DB::table('alunos')
            ->where('user_id', '=',$idUser)
            ->get();

        $videoaulas = DB::table('videoaulas')->select(DB::raw('videoaulas.*,professors.id, professors.nome,professors.foto_perfil, videoaulas.created_at as datacriacao'))
            ->leftJoin('professors', 'professors.id', '=', 'videoaulas.professor_id')
            ->where('videoaulas.category_id', '=',5)
            ->where('videoaulas.status', '=','Ativo')
            ->get();
        //dd($videoaulas);

        return view('layouts.site.area-aluno.cursos-presenciais', compact('videoaulas', 'aluno'));
    }

    public function listarConteudoPresencial(){
      //LISTAR NA ADMINISTACAO DOS VIDEOS PRESENCIAL
      $videoaulas = Videoaula::where('category_id','=',5)->get();

      $categories = Category::all();
      $professors = Professor::all();
      return view('adm.videoaulas.conteudo-presencial', compact('videoaulas', 'professors','categories'));
    }

    /* LISTA DE VIDEO CURSO PREMIUM */

    public function verVideo($id)
    {
        if($id != ""){
          if(\Auth::check()){
            $idUser = \Auth::user()->id;
            //dd($idUser);
            $aluno = DB::table('alunos')
                ->where('user_id', '=',$idUser)
                ->get();

            $videoaulas = DB::table('videoaulas')->select(DB::raw('videoaulas.*,professors.id, professors.nome, videoaulas.created_at as datacriacao'))
                ->leftJoin('professors', 'professors.id', '=', 'videoaulas.professor_id')
                ->where('id_youtube', '=',$id)
                ->get();
            //dd($videoaulas);

            return view('layouts.site.area-aluno.ver-video', compact('videoaulas', 'aluno'));
          }
        }
    }

    public function listar()
    {
      //LISTAR NA ADMINISTACAO AS GALERIAS
      $videoaulas = Videoaula::all();
      $categories = Category::all();
      $professors = Professor::all();
      return view('adm.videoaulas.listar', compact('videoaulas', 'professors','categories'));
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
          $req = $request->all();

          $file = array('image' => Input::file('image'));
          $file2 = array('image2' => Input::file('image2'));
          $file3 = array('image3' => Input::file('image3'));

          //var_dump($banner->url_imagem);exit();

          if(Input::file('image') != null){
            $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
            // doing the validation, passing post data, rules and the messages
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
              // send back to the page with the input data and errors
              return Redirect::to('adm/videoaulas/listar')->withInput()->withErrors($validator);
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

          if(Input::file('image2') != null){
            $rules = array('image2' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
            // doing the validation, passing post data, rules and the messages
            $validator = Validator::make($file2, $rules);
            if ($validator->fails()) {
              // send back to the page with the input data and errors
              return Redirect::to('adm/videoaulas/listar')->withInput()->withErrors($validator);
            }
            else {
              // checking file is valid.
              if (Input::file('image2')->isValid()) {


                $destinationPath = 'uploads'; // upload path
                $extension = Input::file('image2')->getClientOriginalExtension(); // getting image extension
                //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
                $nameonly=preg_replace('/\..+$/', '', Input::file('image2')->getClientOriginalName());

                $fileName2 = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image

                Input::file('image2')->move($destinationPath, $fileName2); // uploading file to given path
              }
            }
          }

          if(Input::file('image3') != null){
            $rules = array('image3' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
            // doing the validation, passing post data, rules and the messages
            $validator = Validator::make($file3, $rules);
            if ($validator->fails()) {
              // send back to the page with the input data and errors
              return Redirect::to('adm/videoaulas/listar')->withInput()->withErrors($validator);
            }
            else {
              // checking file is valid.
              if (Input::file('image3')->isValid()) {


                $destinationPath = 'uploads'; // upload path
                $extension = Input::file('image3')->getClientOriginalExtension(); // getting image extension
                //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
                $nameonly=preg_replace('/\..+$/', '', Input::file('image3')->getClientOriginalName());

                $fileName3 = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image

                Input::file('image3')->move($destinationPath, $fileName3); // uploading file to given path
              }
            }
          }

           $videoaula = new Videoaula($req);
          if(Input::file('image') != null){
              $videoaula->miniatura = $destinationPath."/".$fileName;
          }
          if(Input::file('image2') != null){
              $videoaula->material_01 = $destinationPath."/".$fileName2;
          }
          if(Input::file('image3') != null){
              $videoaula->material_02 = $destinationPath."/".$fileName3;
          }

           $videoaula->save();

           Session::flash('success', '<div class="alert alert-success">
                                       Cadastrado conteúdo com sucesso!
                                     </div>');
           //return view('clientes.add');
           return redirect('adm/videoaulas/listar');
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
      $videoaula = Videoaula::find($id);
      $categories = Category::all();
      $professors = Professor::all();
      return view('adm.videoaulas.edit', compact('videoaula', 'professors','categories'));
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
       $input = $request->all();
       $videoaula = Videoaula::find($id);

       $file = array('miniatura' => $request['miniatura']);
       $file2 = array('material_01' => $request['material_01']);
       $file3 = array('material_02' => $request['material_02']);

       $fileName = '';
       $fileName2 = '';
       $fileName3 ='';
       $destinationPath = 'uploads';

       //var_dump($banner->url_imagem);exit();

       if($request['miniatura'] != null){
         $rules = array('miniatura' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
         // doing the validation, passing post data, rules and the messages
         $validator = Validator::make($file, $rules);
         if ($validator->fails()) {
           // send back to the page with the input data and errors
           return Redirect::to('adm/videoaulas/listar')->withInput()->withErrors($validator);
         }
         else {
           // checking file is valid.
           if (Input::hasFile('miniatura')){


             $destinationPath = 'uploads'; // upload path
             $extension = Input::file('miniatura')->getClientOriginalExtension(); // getting image extension
             //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
             $nameonly=preg_replace('/\..+$/', '', Input::file('miniatura')->getClientOriginalName());

             $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image


             Input::file('miniatura')->move($destinationPath, $fileName); // uploading file to given path
           }
         }
       }



       if($request['material_01'] != null){
         $rules = array('material_01' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
         // doing the validation, passing post data, rules and the messages
         $validator = Validator::make($file2, $rules);
         if ($validator->fails()) {
           // send back to the page with the input data and errors
           return Redirect::to('adm/videoaulas/listar')->withInput()->withErrors($validator);
         }
         else {
           // checking file is valid.
           if (Input::hasFile('material_01')){


             $destinationPath = 'uploads'; // upload path
             $extension = Input::file('material_01')->getClientOriginalExtension(); // getting image extension
             //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
             $nameonly=preg_replace('/\..+$/', '', Input::file('material_01')->getClientOriginalName());

             $fileName2 = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image

             Input::file('material_01')->move($destinationPath, $fileName2); // uploading file to given path
           }
         }
       }

       if($request['material_02'] != null){
         $rules = array('material_02' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
         // doing the validation, passing post data, rules and the messages
         $validator = Validator::make($file3, $rules);
         if ($validator->fails()) {
           // send back to the page with the input data and errors
           return Redirect::to('adm/videoaulas/listar')->withInput()->withErrors($validator);
         }
         else {
           // checking file is valid.
           if (Input::hasFile('material_02')){


             $destinationPath = 'uploads'; // upload path
             $extension = Input::file('material_02')->getClientOriginalExtension(); // getting image extension
             //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
             $nameonly=preg_replace('/\..+$/', '', Input::file('material_02')->getClientOriginalName());

             $fileName3 = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image

             Input::file('material_02')->move($destinationPath, $fileName3); // uploading file to given path
           }
         }
       }


       if (Input::hasFile('miniatura')){
           $input['miniatura']  = $destinationPath."/".$fileName;
       }
       if (Input::hasFile('material_01')){
           $input['material_01'] = $destinationPath."/".$fileName2;
       }
       if (Input::hasFile('material_02')){
           $input['material_02'] = $destinationPath."/".$fileName3;
       }

       //var_dump($input); exit();

       $videoaula->fill($input)->save();

       Session::flash('success', '<div class="alert alert-success">
                                   Atualizado com sucesso!
                                 </div>');

      return redirect('adm/videoaulas/listar');
     }

     public function verCarrinho()
     {
       //category_id = 3 => Premiun Paga
       $videoaula = DB::table('videoaulas')->select('*','videoaulas.id as video_id')
           ->leftJoin('professors', 'professors.id', '=', 'videoaulas.professor_id')
           ->where('category_id', '=',3)
           ->where('status', '=','Ativo')
           ->get();
      $reviews = DB::table('reviews')->selectRaw('reviews.id,reviews.review, reviews.user_id, reviews.status, users.id, users.name,alunos.user_id,alunos.img_perfil')
               	->leftJoin('users', 'users.id', '=', 'reviews.user_id')
               	->leftJoin('alunos', 'alunos.user_id', '=', 'reviews.user_id')
        		->where('reviews.status','=','Ativo')
               	->orderBy('reviews.review', 'DESC')
               	->get();

       return view('layouts.site.carrinho', compact('videoaula', 'reviews'));
     }

     public function retornaPagamento(Request $request){
        //criar um processamento via post
        if(isset($request['currency'])){
          $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';
         /*
          Caso utilizar o formato acima remova todo código abaixo até instrução $data = http_build_query($data);
          */
          $data = $request->all();
          //var_dump($data); exit();

          $data['email'] = $this->emailPagseguro;
          $data['token'] = $this->tokenPgaseguro;
          $data['receiverEmail'] = "mvpnutricaosuporte@hotmail.com";
          $data['notificationURL'] = "http://portaldbm.com.br/homolog/painel/public/confirmar-pagamentos";
          $data['paymentMode'] = "default";
          $data['extraAmount'] = "0.00";
          //$data['shippingCost'] = "0.00";

          //para impedir fraude no valor passado pelo FORM
          $video = Videoaula::findOrFail($data['curso_id']);
          $data['itemAmount1'] = $video->valor;
          $data['itemDescription1'] = utf8_decode($video->tema);
          $data['reference'] = $video->reference;

          /*
          $data['currency'] = 'BRL';
          $data['itemId1'] = '0001';
          $data['itemDescription1'] = 'Notebook Prata';
          $data['itemAmount1'] = '24.00';
          $data['itemQuantity1'] = '1';
          $data['itemWeight1'] = '1000';
          $data['itemId2'] = '0002';
          $data['itemDescription2'] = 'Notebook Rosa';
          $data['itemAmount2'] = '20.00';
          $data['itemQuantity2'] = '2';
          $data['itemWeight2'] = '750';
          $data['reference'] = 'REF1234';
          */
          /*
          $data['senderName'] = 'Jose Comprador';
          $data['senderAreaCode'] = '11';
          $data['senderPhone'] = '56273440';
          $data['senderEmail'] = 'comprador@uol.com.br';
          //setShippingType
          */
          $data['shippingType'] = '3';
          /*
          $data['shippingAddressStreet'] = 'Av. Brig. Faria Lima';
          $data['shippingAddressNumber'] = '1384';
          $data['shippingAddressComplement'] = '5o andar';
          $data['shippingAddressDistrict'] = 'Jardim Paulistano';
          $data['shippingAddressPostalCode'] = '01452002';
          $data['shippingAddressCity'] = 'Sao Paulo';
          $data['shippingAddressState'] = 'SP';
          $data['shippingAddressCountry'] = 'BRA';
          */
          $data['redirectURL'] = 'http://portaldbm.com.br/homolog/painel/public/confirmar-pagamento';

          $data = http_build_query($data);

          $curl = curl_init($url);

          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          $xml= curl_exec($curl);

          if($xml == 'Unauthorized'){
          //Insira seu código de prevenção a erros
              var_dump($xml);
              //header('Location: erro.php?tipo=autenticacao');
              exit;//Mantenha essa linha
          }
          curl_close($curl);

          $xml= simplexml_load_string($xml);
          if(count($xml -> error) > 0){
              //Insira seu código de tratamento de erro, talvez seja útil enviar os códigos de erros.
              var_dump($xml -> error);
              //header('Location: erro.php?tipo=dadosInvalidos');
              exit;
          }
              header('Location: https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $xml -> code);
          }


     }

     public function getTrasactionURL(){
       if(isset($_GET['transaction_id'])){
         $email = $this->emailPagseguro;
         $token = $this->tokenPgaseguro;


         $url = "https://ws.pagseguro.uol.com.br/v2/transactions/". $_GET['transaction_id'] . "?email=".$email."&token=".$token;
         //var_dump($url);
         $curl = curl_init($url);
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
         $transaction= curl_exec($curl);
         curl_close($curl);

         if($transaction == 'Unauthorized'){
             //Insira seu código avisando que o sistema está com problemas, sugiro enviar um e-mail avisando para alguém fazer a manutenção

             exit;//Mantenha essa linha
         }
         $transaction = @simplexml_load_string($transaction);

         $status ='';
         if(count($transaction) > 0){

           switch ((int)$transaction->status) {
             case 1:
                 $status = "Aguardando pagamento";
               break;

            case 2:
                 $status = "Em análise";
               break;

            case 3:
                $status = "Paga";
              break;

            case 4:
                $status = "Disponível";
              break;

            case 5:
                 $status = "Em disputa";
               break;

            case 6:
                $status = "Devolvida";
              break;

            case 7:
                $status = "Cancelada";
              break;
           }
         }

         //gravar em um log em banco de dados
         $transacao = json_encode($transaction);
         try {
           //DESATIVADO O LOG PARA ESTE RECURSO TEMPORARIAMENTE
           //DB::table('pagseguro_log')->insert(
            //   ['resposta_xml' => $transacao,'status'=>$status, 'transaction_id' =>$_GET['transaction_id']]
           //);


           $nomeComprador   = (string)$transaction->sender->name;
           $emailComprador  = (string)$transaction->sender->email;
           $logradouro      = (string)$transaction->shipping->address->street;
           $numero          = (int)$transaction->shipping->address->number;
           $complemento     = (string)$transaction->shipping->address->complement;
           $bairro          = (string)$transaction->shipping->address->district;
           $cidade          = (string)$transaction->shipping->address->city;
           $estado          = (string)$transaction->shipping->address->state;
           $cep             = (int)$transaction->shipping->address->postalCode;

           $SenhaTemp = "SenhaTemp".date('Ymd');

           //verficar se usuario jah existe na base
           $userVerify = DB::select(DB::raw("SELECT * FROM users WHERE email='".$emailComprador."';"));

           if($status == "Paga" || $status == "Disponível"){
                if(count($userVerify) == 0){

                   //criando o usuario
                   $userAluno =  User::create([
                      'name' => $nomeComprador,
                      'email' => $emailComprador,
                      'password' => bcrypt($SenhaTemp),
                    ]);
                   //retorna o ultimo User cadastradado
                   $insertedId = $userAluno->id;
                   /*
                    INSERIR DADOS DO ALUNO
                    `user_id`, `nome`,`cep`, `logradouro`, `numero`, `complemento`, `cidade`, `estado`, `bairro`, `status`, `plano_acesso`
                   */
                    $alunoInsert = Aluno::create([
                        'user_id' => $insertedId,
                        'nome' => $nomeComprador,
                        'cep' => $cep,
                        'logradouro' => $logradouro,
                        'numero' => $numero,
                        'complemento' =>$complemento,
                        'cidade' => $cidade,
                        'estado'=> $estado,
                        'bairro'=> $bairro,
                        'status'=>'Ativo',
                        'plano_acesso'=>'Premiun',
                        'created_at' => date('Y-m-d H:i:s')
                      ]);
                    //ENVIAR ACESSO COM SENHA PARA EMAIL DO COMPRADOR
                    try {
                        Mail::send('layouts.site.email-compra', array(
                                'NomeAluno'=> $nomeComprador,
                                'Assunto'=>'Acesso Liberado ao Curso no Portal DBM',
                                'SenhaTemporaria'=> $SenhaTemp,
                                'EmailAluno'=> $emailComprador
                                ), function($message){
                            //So funciona no contexto aqui interno

                             $mensagem = "Acesso Liberado ao Curso no Portal DBM";
                             //$userVendedor = DB::table('users')->where('id', $id_destinatario)->first();
                               $email = $this->emailPagseguro;
                               $token = $this->tokenPgaseguro;


                               $url = "https://ws.pagseguro.uol.com.br/v2/transactions/". $_GET['transaction_id'] . "?email=".$email."&token=".$token;
                               //var_dump($url);
                               $curl = curl_init($url);
                               curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                               $transaction= curl_exec($curl);
                               curl_close($curl);
                               $transaction = @simplexml_load_string($transaction);

                             $message->to( (string)$transaction->sender->email, (string)$transaction->sender->name)->subject($mensagem);


                        });

                       // flash('Mensagem enviada com sucesso!', 'success');
                       echo '<script> alert("Mensagem com o seu acesso ao curso enviado para '.$emailComprador.'!");</script>';

                     } catch (Exception $exc) {
                         echo $exc->getTraceAsString();
                     }

                } else {
                    //USUARIO JAH EXISTE CADASTRADO

                  //verificar se usuario jah possuicadastro como Aluno
                  $alunoVerify = DB::select(DB::raw("SELECT * FROM alunos WHERE user_id='".$userVerify[0]->id."';"));
                  //atualizar Aluno Comprador
                  //atualizar Aluno Comprador
                   DB::table('alunos')
                    ->where('id', $alunoVerify[0]->id)
                    ->update(['plano_acesso'=>"Premiun"]);
                  //var_dump($alunoVerify); exit();
                    //ENVIAR ACESSO COM SENHA PARA EMAIL DO COMPRADOR
                    try {
                        Mail::send('layouts.site.email-compra', array(
                                'NomeAluno'=> $nomeComprador,
                                'Assunto'=>'Acesso Liberado ao Curso no Portal DBM',
                                'SenhaTemporaria'=> $SenhaTemp,
                                'EmailAluno'=> $emailComprador
                                ), function($message){
                            //So funciona no contexto aqui interno

                             $mensagem = "Acesso Liberado ao Curso no Portal DBM";
                              //RESGATANDO O NOME E EMAIL VINDO DO PAGSEGURO
                               $email = $this->emailPagseguro;
                               $token = $this->tokenPgaseguro;
                               $url = "https://ws.pagseguro.uol.com.br/v2/transactions/". $_GET['transaction_id'] . "?email=".$email."&token=".$token;
                               //var_dump($url);
                               $curl = curl_init($url);
                               curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                               $transaction= curl_exec($curl);
                               curl_close($curl);
                               $transaction = @simplexml_load_string($transaction);

                             $message->to( (string)$transaction->sender->email, (string)$transaction->sender->name)->subject($mensagem);

                        });

                       // flash('Mensagem enviada com sucesso!', 'success');
                       echo '<script> alert("Mensagem com o seu acesso ao curso enviado para '.$emailComprador.'!");</script>';

                     } catch (Exception $exc) {
                         echo $exc->getTraceAsString();
                     }

                }
           }  //fim da confirmacao paga

           //==== QUANDO O STATUS FOR DIFERENTE DE PAGO ===========================




         } catch (Exception $e) {

         }
         return view('layouts.site.confirmar-compra', compact('status'));
       }
     }

     /*
        RECUPERAR INFORMACOES DA TRANSACAO PELO SEU transaction_id
        VISAO DO ALUNO
     */
     public function getInformacoesPagseguroByCode($code){
       //https://ws.pagseguro.uol.com.br/v3/transactions/F7F81E8F-FBAC-45BB-87D9-B4C6ED2AF7DF?email=mvpnutricaosuporte@hotmail.com&token=9EAE1FC931A94823BF7AB99C57F347CC

         //RESGATANDO O NOME E EMAIL VINDO DO PAGSEGURO
          $email = $this->emailPagseguro;
          $token = $this->tokenPgaseguro;
          $url = "https://ws.pagseguro.uol.com.br/v2/transactions/". $code . "?email=".$email."&token=".$token;
          //var_dump($url);
          $curl = curl_init($url);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          $transaction= curl_exec($curl);
          curl_close($curl);
          $transaction = @simplexml_load_string($transaction);

          return json_encode($transaction);
     }

     /*
        SERVICO VIA POST - SERVER TO SERVER - PARA NOTIFICAR STATUS DA COMPRA
        DISPARAR EMAIL COM ACESSO CASO A COMPRA TENHA SIDO LIBERADA PARA O USUÁRIO
     */
     public function notificationURL(){
        //$this->getTrasactionURL();
        if(isset($_POST['notificationCode']) && $_POST['notificationType'] == 'transaction'){
           //Todo resto do código iremos inserir aqui.

           $email = $this->emailPagseguro;
           $token = $this->tokenPgaseguro;

           $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;

           $curl = curl_init($url);
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
           $transaction= curl_exec($curl);
           curl_close($curl);

           if($transaction == 'Unauthorized'){
               //Insira seu código avisando que o sistema está com problemas, sugiro enviar um e-mail avisando para alguém fazer a manutenção

               exit;//Mantenha essa linha
           }
           $transaction = @simplexml_load_string($transaction);

           $status ='';
           if(count($transaction) > 0){

             switch ((int)$transaction->status) {
               case 1:
                   $status = "Aguardando pagamento";
                 break;

              case 2:
                   $status = "Em análise";
                 break;

              case 3:
                  $status = "Paga";
                break;

              case 4:
                  $status = "Disponível";
                break;

              case 5:
                   $status = "Em disputa";
                 break;

              case 6:
                  $status = "Devolvida";
                break;

              case 7:
                  $status = "Cancelada";
                break;
             }
           }
           //gravar em um log em banco de dados
           $transacao = json_encode($transaction);
           try {
             DB::table('pagseguro_log')->insert(
                 ['resposta_xml' => $transacao,'status'=>$status,  'transaction_id' =>$_POST['notificationCode']]
             );

                 $nomeComprador   = (string)$transaction->sender->name;
                 $emailComprador  = (string)$transaction->sender->email;
                 $logradouro      = (string)$transaction->shipping->address->street;
                 $numero          = (int)$transaction->shipping->address->number;
                 $complemento     = (string)$transaction->shipping->address->complement;
                 $bairro          = (string)$transaction->shipping->address->district;
                 $cidade          = (string)$transaction->shipping->address->city;
                 $estado          = (string)$transaction->shipping->address->state;
                 $cep             = (int)$transaction->shipping->address->postalCode;

                 $SenhaTemp = "SenhaTemp".date('Ymd');

                 //verficar se usuario jah existe na base
                 $userVerify = DB::select(DB::raw("SELECT * FROM users WHERE email='".$emailComprador."';"));

                 if($status == "Paga" || $status == "Disponível"){
                      if(count($userVerify) == 0){

                         //criando o usuario
                         $userAluno =  User::create([
                            'name' => $nomeComprador,
                            'email' => $emailComprador,
                            'password' => bcrypt($SenhaTemp),
                          ]);
                         //retorna o ultimo User cadastradado
                         $insertedId = $userAluno->id;
                         /*
                          INSERIR DADOS DO ALUNO
                          `user_id`, `nome`,`cep`, `logradouro`, `numero`, `complemento`, `cidade`, `estado`, `bairro`, `status`, `plano_acesso`
                         */
                          $alunoInsert = Aluno::create([
                              'user_id' => $insertedId,
                              'nome' => $nomeComprador,
                              'cep' => $cep,
                              'logradouro' => $logradouro,
                              'numero' => $numero,
                              'complemento' =>$complemento,
                              'cidade' => $cidade,
                              'estado'=> $estado,
                              'bairro'=> $bairro,
                              'status'=>'Ativo',
                              'plano_acesso'=>'Premiun',
                              'created_at' => date('Y-m-d H:i:s')
                            ]);
                          //ENVIAR ACESSO COM SENHA PARA EMAIL DO COMPRADOR
                          try {
                              Mail::send('layouts.site.email-compra', array(
                                      'NomeAluno'=> $nomeComprador,
                                      'Assunto'=>'Acesso Liberado ao Curso no Portal DBM',
                                      'SenhaTemporaria'=> $SenhaTemp,
                                      'EmailAluno'=> $emailComprador
                                      ), function($message){
                                  //So funciona no contexto aqui interno

                                   $mensagem = "Acesso Liberado ao Curso no Portal DBM";
                                   //$userVendedor = DB::table('users')->where('id', $id_destinatario)->first();
                                     $email = $this->emailPagseguro;
                                     $token = $this->tokenPgaseguro;


                                    $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;
                                     //var_dump($url);
                                     $curl = curl_init($url);
                                     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                     $transaction= curl_exec($curl);
                                     curl_close($curl);
                                     $transaction = @simplexml_load_string($transaction);

                                   $message->to( (string)$transaction->sender->email, (string)$transaction->sender->name)->subject($mensagem);


                              });

                             // flash('Mensagem enviada com sucesso!', 'success');
                             //echo '<script> alert("Mensagem com o seu acesso ao curso enviado para '.$emailComprador.'!");</script>';

                           } catch (Exception $exc) {
                               echo $exc->getTraceAsString();
                           }

                      } else {
                          //USUARIO JAH EXISTE CADASTRADO

                        //verificar se usuario jah possuicadastro como Aluno
                        $alunoVerify = DB::select(DB::raw("SELECT * FROM alunos WHERE user_id='".$userVerify[0]->id."';"));
                        //var_dump($alunoVerify); exit();
                          //ENVIAR ACESSO COM SENHA PARA EMAIL DO COMPRADOR
                          try {
                              Mail::send('layouts.site.email-compra', array(
                                      'NomeAluno'=> $nomeComprador,
                                      'Assunto'=>'Acesso Liberado ao Curso no Portal DBM',
                                      'SenhaTemporaria'=> $SenhaTemp,
                                      'EmailAluno'=> $emailComprador
                                      ), function($message){
                                  //So funciona no contexto aqui interno

                                   $mensagem = "Acesso Liberado ao Curso no Portal DBM";
                                    //RESGATANDO O NOME E EMAIL VINDO DO PAGSEGURO
                                     $email = $this->emailPagseguro;
                                     $token = $this->tokenPgaseguro;
                                     $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;
                                     //var_dump($url);
                                     $curl = curl_init($url);
                                     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                     $transaction= curl_exec($curl);
                                     curl_close($curl);
                                     $transaction = @simplexml_load_string($transaction);

                                   $message->to( (string)$transaction->sender->email, (string)$transaction->sender->name)->subject($mensagem);

                              });

                             // flash('Mensagem enviada com sucesso!', 'success');
                            //echo '<script> alert("Mensagem com o seu acesso ao curso enviado para '.$emailComprador.'!");</script>';

                           } catch (Exception $exc) {
                               echo $exc->getTraceAsString();
                           }

                      }
                 }  //fim da confirmacao paga


           } catch (Exception $e) {

           }


        }
     }

     /*
        METODO PARA MOSTRAR TOTAL NO ADMIN DE COMPRAS BEM SUCEDIDAS
        STATUS = PAGA VINDOS DO LOG DO SISTEMA
      */
    public function getTotalComprasPagas(){
      /*
              SELECT * FROM `pagseguro_log`
        WHERE status = 'Paga'
        GROUP BY transaction_id
      */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Videoaula::findOrFail($id)->delete();

      Session::flash('success', '<div class="alert alert-success">
                                  Conteúdo apagado com sucesso!
                                </div>');

      return redirect('adm/videoaulas/listar');
    }
}
