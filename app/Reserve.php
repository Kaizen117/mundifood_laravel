<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Reserve extends Model
{
    //use SoftDeletes;
    
    protected $table = 'reserves';
    protected $fillable=[
        'table_id', 'user_id', 'diner_number', 'date', 'hour', 'observations',
    ];
    
    //necesario si queremos rescatar en la plantilla index de reservas los datos del id del usuario: <td>{{ $reserve->user->name }} {{ $reserve->user->surname1 }} {{ $reserve->user->surname2 }}</td>
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
