<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'imagem_destaque',
        'url_imagem',
        'titulo_destaque',
        'subtitulo',
        'texto_link',
        'link_botao'
    ];
}
