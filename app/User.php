<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Szykra\Guard\Contracts\Permissible;
use Szykra\Guard\Traits\Permissions;

class User extends Authenticatable implements Permissible
{
    use HasApiTokens, Notifiable, Permissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role', 'role_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('Szykra\Guard\Models\Role');
    }

    public function transactions(){
        return $this->belongsToMany('App\Transaction', 'transaction_pivot', 'user_id', 'tx_id')
        ->withTimestamps();
    }

    public function balance()
    {
        return $this->hasOne('App\Balance');
    }

    public function history(){
        return DB::table('users')
        ->select('users.name', 'transaction_pivot.user_id','transaction_pivot.to_id', 'transactions.amount', 'transaction_type.type', 'transaction_pivot.created_at', 'transaction_pivot.updated_at')
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
        ->orderBy('created_at', 'DESC')
        ->get();
    }
}
