<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dbmcurso extends Model
{
    /*
    $table->string('video_id', 50);
    $table->string('titulo', 50);
    $table->strig('descricao', 200);
    */
    protected $table = 'dbmcursos';
    protected $fillable = ['video_id', 'titulo', 'descricao'];
}
