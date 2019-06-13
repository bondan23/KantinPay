<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopUp extends Model
{
    protected $table = 'topups';

    protected $fillable = [
        'request_balance', 'confirmed', 'user_id'
    ];

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
