<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeria;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use File;
use DB;

class GaleriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
          mostrando as galerias no site do portal
        */
        //$galerias = Galeria::all();
        $galerias = DB::table('galerias')->select(DB::raw("*"))->get();
        return view('layouts.site.galeria', compact('galerias'));
    }
    public function listarImagens($id){
    $galerias = DB::table('item_galerias')->select(DB::raw("galerias.id,item_galerias.galery_id, item_galerias.url_imagem, item_galerias.legenda, item_galerias.created_at, galerias.titulo,galerias.descricao_curta"))->leftJoin('galerias', 'galerias.id','=','item_galerias.galery_id')->where('item_galerias.galery_id', $id)->get();
        return view('layouts.site.ver-galeria',compact('galerias'));

    }

    public function listar()
    {
        //LISTAR NA ADMINISTACAO AS GALERIAS
        $galerias = Galeria::paginate(5);
        return view('adm.galerias.galeria', compact('galerias'));
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

            $galeria = new Galeria($req);
            //var_dump($user); exit();

            $file = array('image' => Input::file('image'));
            $file2 = array('image2' => Input::file('image2'));

             //var_dump($banner->url_imagem);exit();

             if(Input::file('image') != null){
               // setting up rules
               $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
               // doing the validation, passing post data, rules and the messages
               $validator = Validator::make($file, $rules);
               if ($validator->fails()) {
                 // send back to the page with the input data and errors
                 return Redirect::to('adm/galerias')->withInput()->withErrors($validator);
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
               // setting up rules
               $rules = array('image2' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
               // doing the validation, passing post data, rules and the messages
               $validator = Validator::make($file2, $rules);
               if ($validator->fails()) {
                 // send back to the page with the input data and errors
                 return Redirect::to('adm/galerias')->withInput()->withErrors($validator);
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

             //salvando os dados do banner
             if(Input::file('image') != null){
                 $galeria->url_thumb = $destinationPath."/".$fileName;
             }

              if(Input::file('image2') != null){
                 $galeria->url_imagem = $destinationPath."/".$fileName2;
             }

            $galeria->save();

            Session::flash('success', '<div class="alert alert-success">
                                        Cadastrado galeria com sucesso!
                                      </div>');
            //return view('clientes.add');
            return redirect('adm/galerias');
    }
	
	
	public function ajaxMultiUpload(Request $request){
		$files = $request->all();
		//var_dump($files);
		// 'file-es' refers to your file input name attribute
		if (empty($files['image2'])) {
    		echo json_encode(['error'=>'No files found for upload.']);
    		// or you can throw an exception
    		return; // terminate
		}
		// get the files posted
		$images = $files['image2'];

		
		// a flag to see if everything is ok
		$success = null;

		// file paths to store
		$paths= [];

		// get file names
		$filenames = $images;
	
		$file = array('image' => Input::file('image2'));
		
	
		 if(Input::file('image2') != null){
               // setting up rules
               $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
               // doing the validation, passing post data, rules and the messages
               $validator = Validator::make($file, $rules);
               if ($validator->fails()) {
                 // send back to the page with the input data and errors
                 $success = false;
        		  
               }
               else {
                 // checking file is valid.
                 if (Input::file('image2')[0]->isValid()) {
					       $file = Input::file('image2');
                   $destinationPath = 'uploads'; // upload path
                   
                   $extension = $images[0]->getClientOriginalExtension(); // getting image extension
                   //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
                   $nameonly=preg_replace('/\..+$/', '', $file[0]->getClientOriginalName());
                   $target  = public_path()."/uploads" . DIRECTORY_SEPARATOR .$this->tirarAcento($nameonly).'.'.$extension;
                   
                   $fileName = $this->tirarAcento($nameonly).'.'.$extension; // renameing image
                   $file[0]->move($destinationPath, $fileName); // uploading file to given path
                   $success = true;
        			$paths[] = $target;
                }
               }
             }

		// check and process based on successful status
		if ($success === true) {

    	 //GRAVANDO AS INFORMACOES RELACIONADAS A GALERIA  
      try {
        /*
          `galery_id`
          `url_imagem`
          `legenda`
          `created_at`
        */
        
         DB::table('item_galerias')->insert(
                 ['galery_id' => $files['galery_id'],'url_imagem'=>"/uploads" . DIRECTORY_SEPARATOR .$this->tirarAcento($nameonly).'.'.$extension ,'created_at' =>date('Y-m-d H:i:s')]
             );
      } catch (Exception $e) {
        
      }
       
    		$output = [];
    		// for example you can get the list of files uploaded this way
    		// $output = ['uploaded' => $paths];
		} elseif ($success === false) {
    		$output = ['error'=>'Error while uploading images. Contact the system administrator'];
    		// delete any uploaded files
    		foreach ($paths as $file) {
        		unlink($file);
    		}
		} else {
    		$output = ['error'=>'No files were processed.'];
		}

		// return a json encoded response for plugin to process successfully
		echo json_encode($output);

	}

  public function getMultiImagesGalery($id){
    $galeria = DB::table('item_galerias')->select('item_galerias.*')->leftJoin('galerias', 'galerias.id','=','item_galerias.galery_id')->where('item_galerias.galery_id', $id)->get();
    return json_encode( $galeria );
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
        $galeria = Galeria::find($id);
        return view('adm.galerias.edit', compact('galeria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $input = $request->all();
        $galeria = Galeria::find($id);

        $file = array('image' => Input::file('image'));
        $file2 = array('image2' => Input::file('image2'));

         //var_dump($banner->url_imagem);exit();

         if(Input::file('image') != null){
           // setting up rules
           $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
           // doing the validation, passing post data, rules and the messages
           $validator = Validator::make($file, $rules);
           if ($validator->fails()) {
             // send back to the page with the input data and errors
             return Redirect::to('adm/galerias')->withInput()->withErrors($validator);
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
           // setting up rules
           $rules = array('image2' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
           // doing the validation, passing post data, rules and the messages
           $validator = Validator::make($file2, $rules);
           if ($validator->fails()) {
             // send back to the page with the input data and errors
             return Redirect::to('adm/galerias')->withInput()->withErrors($validator);
           }
           else {
             // checking file is valid.
            /*
             if (Input::file('image2')[0]->isValid()) {

               $destinationPath = 'uploads'; // upload path
               $extension = Input::file('image2')[0]->getClientOriginalExtension(); // getting image extension
               //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
               $nameonly=preg_replace('/\..+$/', '', Input::file('image2')[0]->getClientOriginalName());
               $fileName2 = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image
               Input::file('image2')[0]->move($destinationPath, $fileName2); // uploading file to given path
             }
            */
           }
         }

         //salvando os dados do banner
         if(Input::file('image') != null){
             $galeria->url_thumb = $destinationPath."/".$fileName;
         }

          if(Input::file('image2') != null){
             //$galeria->url_imagem = $destinationPath."/".$fileName2;
         }

        $galeria->fill($input)->save();

        Session::flash('success', '<div class="alert alert-success">
                                    Atualizado com sucesso!
                                  </div>');


        //return view('adm.banner.edit', compact('banner'));
       return redirect('adm/galerias');
    }

    public function destroyImageGalery($id){
      //METODO QUE INTERAGE COM O PLUGIN BOOTSTRAP FILEINPUT PARA APAGAR IMAGEM
      $retorno = ['send'=>false];
      try {
        //resgatar nome da imagem
        $itemImagem = DB::table('item_galerias')->select('item_galerias.*')->where('id', '=',$id)->get();
        $target  = (count($itemImagem) > 0)? public_path()."/".$itemImagem[0]->url_imagem : null;
        if($target != null){
          if (File::exists($target)) {
            File::delete( $target);
          }
        }
        DB::table('item_galerias')->where('id', '=', $id)->delete();
        $retorno['send']=true;
        return json_encode($retorno);
      } catch (Exception $e) {
        return json_encode($retorno);
      }
      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //apagar depoimento
     public function destroy($id)
     {
       Galeria::findOrFail($id)->delete();

       Session::flash('success', '<div class="alert alert-success">
                                   Conteúdo da galeria apagado com sucesso!
                                 </div>');

       return redirect('adm/galerias');
     }
}
