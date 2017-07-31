<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresainfo extends Model
{
  protected $table = 'empresainfos';

  protected $fillable = [
      'nome','email_contato','telefone','facebook','instagram','twitter','youtube'

  ];
}
