<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sobreadbm extends Model
{
  protected $table = 'sobreadbms';

  protected $fillable = [
      'titulo',
      'url_youtube',
      'descricao_curta',
      'url_externa'
  ];
}
