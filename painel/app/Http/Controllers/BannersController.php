<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use File;

use App\Http\Requests;
use App\Banner;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    //======================================================
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('adm.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){

        $banner = Banner::find($id);
        //tratando a imagem a ser atualizada
        $file = array('image' => Input::file('image'));

        //var_dump($banner->url_imagem);exit();

        if(Input::file('image') != null){


          // setting up rules
          $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
          // doing the validation, passing post data, rules and the messages
          $validator = Validator::make($file, $rules);
          if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('adm/banner/edit/'.$id)->withInput()->withErrors($validator);
          }
          else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
              //apagando imagem anterior cadastrada
               if(isset($banner->url_imagem)){
                   //apagar arquvivo pelo caminho
                   File::delete( $banner->url_imagem);
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

        //salvando os dados do banner
        $banners = Banner::findOrFail($id);
        if(Input::file('image') != null){

            $banners->imagem_destaque = $fileName;
            $banners->url_imagem = $destinationPath."/".$fileName;

        }
        $input = $request->all();
        $banners->fill($input)->save();

        Session::flash('success', '<div class="alert alert-success">
                                    Atualizado com sucesso!
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
      Banner::findOrFail($id)->delete();

      Session::flash('success', '<div class="alert alert-success">
                                  Apagado com sucesso!
                                </div>');

      return redirect('adm/list');
    }

    public function tirarAcento($frase){
      $frase = preg_replace("[^a-zA-Z0-9_.]", "",
      strtr($frase, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ",
      "aaaaeeiooouucAAAAEEIOOOUUC-"));
      $frase = strtolower($frase); //Transforma em minúscula
      $frase = str_replace(' ', '-', $frase);
      $frase = str_replace('.', '', $frase);
      return $frase;
    }
}
