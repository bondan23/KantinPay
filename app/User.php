<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transactions(){
        return $this->belongsToMany('App\Transaction', 'transaction_pivot', 'user_id', 'tx_id')
        ->withTimestamps();
    }

    public function history(){
        return DB::table('users')
        ->select('users.name', 'transaction_pivot.user_id','transaction_pivot.to_id','transactions.amount', 'transaction_type.type')
        ->selectSub(function ($query) {
            $query->selectRaw('(select name from users where id = transaction_pivot.to_id)');
        }, 'receiver')
        ->join('transaction_pivot','transaction_pivot.user_id', '=', 'users.id')
        ->join('transactions','transaction_pivot.tx_id', '=', 'transactions.id')
        ->join('transaction_type','transactions.tx_type_id', '=', 'transaction_type.id')
        ->where(function($where){
            $where->where('transaction_pivot.user_id', '=', $this->id)
                ->orWhere('transaction_pivot.to_id', '=', $this->id);
        })
        ->get();
    }
}
