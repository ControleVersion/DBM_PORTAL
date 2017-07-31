<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    protected $table = 'profissionais';

    protected $fillable =['nome', 'foto', 'formacao', 'descricao', 'facebook', 'instagram'];
}
