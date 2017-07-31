<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videoaula extends Model
{
    /*
    `professor_id`,
    `category_id`,
    `tema`,
    `duracao`,
    `resumo`,
    id_youtube,
    `miniatura`,
    `material_01`,
    `material_02`,
    */
    protected $fillable = [
      'professor_id',
      'category_id',
      'tema',
      'duracao',
      'resumo',
      'id_youtube',
      'miniatura',
      'material_01',
      'reference',
      'valor',
      'valor_bruto',
      'status',
      'material_02',
    ];
}
