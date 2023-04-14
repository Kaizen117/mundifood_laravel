<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishes';
    protected $fillable=[
        'name', 'image', 'price', 'description', 'category', 'disponibility',
    ];
}
