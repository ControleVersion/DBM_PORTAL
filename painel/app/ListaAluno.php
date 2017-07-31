<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaAluno extends Model
{
    protected $table = 'lista_de_alunos';

    protected $fillable =['nome', 'email'];
}
