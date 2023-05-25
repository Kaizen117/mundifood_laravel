<?php

namespace App;

use App\Reserve;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    //use SoftDeletes;

    protected $table = 'tables';
    protected $fillable=[
        'diner_number', 'place',
    ];
    
    //indicamos a Eloquent que el campo table_number no será como clave primaria autoincremental
    public $incrementing = false;

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }

}
