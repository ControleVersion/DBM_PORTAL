<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use Request;
use Session;
use App\Banner;
use DB;
class ApplyController extends Controller {
  public function upload() {
    // getting all of the post data
    $file = array('image' => Input::file('image'));
    // setting up rules
    $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
    // doing the validation, passing post data, rules and the messages
    $validator = Validator::make($file, $rules);
    if ($validator->fails()) {
      // send back to the page with the input data and errors
      return Redirect::to('upload')->withInput()->withErrors($validator);
    }
    else {
      // checking file is valid.
      if (Input::file('image')->isValid()) {
        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
        $nameonly=preg_replace('/\..+$/', '', Input::file('image')->getClientOriginalName());

        $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image

        $dadosArchive =['menu_pai'=> "", 'menu_name'=> "", 'archive_name'=> "", 'url_archive'=>"", 'user_id'=>0, 'company_id'=>0];

        $dadosArchive = [
            'imagem_destaque'=>$fileName,
            'url_imagem'=> $destinationPath."/".$fileName,
            'titulo_destaque' => $_POST['titulo_destaque'],
            'subtitulo' => $_POST['subtitulo'],
            'texto_link' => $_POST['texto_link'],
            'link_botao' => $_POST['link_botao']
        ];

        //var_dump($dadosArchive);exit();
        //gravar antes de mover o arquivo
        if($dadosArchive['url_imagem'] != '' && $dadosArchive['titulo_destaque'] != '' && $dadosArchive['subtitulo'] != ""){
          /*
          'imagem_destaque',
          'url_imagem',
          'titulo_destaque',
          'subtitulo',
          'texto_link',
          'link_botao'
          */
          $reqArquive = new Banner($dadosArchive);
          $reqArquive->save();
        }

        Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message
        Session::flash('success', '<div class="alert alert-success">
                                    Upload concluído com sucesso!
                                  </div>');
        return Redirect::to('adm/list');
      }
      else {
        // sending back with error message.
        Session::flash('error', '<div class="alert alert-danger">Erro ao carregar o arquivo</div>');
        return Redirect::to('adm/list');
      }
    }
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

  public function loadArchives(){
    /*
      'menu_pai',
    'menu_name',
    'archive_name',
    'url_archive',
    'user_id',
    'company_id'
    */
    header('Content-Type: application/json');
    $archives = Archive::all();
    return json_encode($archives);
  }
}
