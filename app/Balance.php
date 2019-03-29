<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'balance', 'user_id'
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }
}
