<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    //
   	protected $fillable = ['titulo', 'descricao_curta', 'url_thumb', 'url_imagem'];
}
