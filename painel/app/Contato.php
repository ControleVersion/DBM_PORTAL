<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    /*
    $table->string('name', 50);
    $table->string('last_name', 80);
    $table->string('email', 120);
    $table->string('phone', 20);
    $table->text('message');
    */
    protected $fillable = ['name', 'last_name', 'email', 'phone', 'message'];
}
