<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degustacaodbm extends Model
{
    protected $table ='degustacaodbms';
    protected $fillable =[
        'descricao_curta',
        'imagem_video',
        'url_imagem',
        'subtitulo',
        'link_externo',
        'professor_id'
    ];
}
