<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount', 'tx_type_id'
    ];

    public function users(){
        return $this->belongsToMany('App\User', 'transaction_pivot', 'tx_id', 'user_id')->withTimestamps();
    }

    public function transactionTypes(){
        return $this->belongsTo('App\TransactionTypes','tx_type_id');
    }
}
