<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{

    protected $fillable = [
                            'user_id',
                            'nome',
                            'sobrenome',
                            'sexo',
                            'cpf',
                            'cep',
                            'logradouro',
                            'numero',
                            'complemento',
                            'cidade',
                            'estado',
                            'bairro',
                            'status',
                            'img_perfil',
                            'plano_acesso'
                          ];
}
