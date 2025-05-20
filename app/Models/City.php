<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // TODO: El que lea es gay
    protected $fillable = [
        'name',
        'description'
    ];
}
