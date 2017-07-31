<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public  function __construct(){

            $videoaula = \DB::table('videoaulas')->select('*','videoaulas.id as video_id')
                    ->leftJoin('professors', 'professors.id', '=', 'videoaulas.professor_id')
                    ->where('category_id', '=',3)
                    ->where('status', '=','Ativo')
                    ->get();
            //criando conteudo para ser exibido em todas as telas
            \Session::set('videoaula', $videoaula);

            $empresaInfo = \App\Empresainfo::all();
            //criando conteudo para ser exibido em todas as telas
            \Session::set('empresaInfo', $empresaInfo);
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
