<?php

namespace App\Http\Controllers;

use App\TopUp;
use App\Withdraw;
use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // $topup = TopUp::where('confirmed', false)->with('users')->get();
        $topup = TopUp::with('users')->where('confirmed',false)->get();
        $withdraw = Withdraw::with('users')->where('confirmed',false)->get();

        return view('home.home', ["topup" => $topup, 'withdraw' => $withdraw]);
    }

    public function action_topup(Request $request, $type = 1, $id = null) {
        $topup = TopUp::find($id);
        
        if($type == 1){
            // Do Some things
            $to = $topup->user_id;
            $user = User::find($to);
            $amount = $topup->request_balance;
            
            // TOPUP RESULT user_id and to_id will be the same
            $transaction = Transaction::create(["amount" => $amount, 'tx_type_id' => 1]);
            $user->transactions()->attach($transaction, ['to_id' => $to]);
            $user->balance()->increment('balance', $amount);
        }

        $topup->confirmed = $type == 1 ? 1 : 3;
        $topup->save();

        return redirect('home'); 
    }

    public function action_withdraw(Request $request, $type = 1, $id = null) {
        $withdraw = Withdraw::find($id);
        
        if($type == 1){
            // Do Some things
            $to = $withdraw->user_id;
            $user = User::find($to);
            $amount = $withdraw->request_balance;
            
            // Withdraw RESULT user_id and to_id will be the same
            $transaction = Transaction::create(["amount" => $amount, 'tx_type_id' => 3]);
            $user->transactions()->attach($transaction, ['to_id' => $to]);
            $user->balance()->decrement('balance', $amount);
        }

        $withdraw->confirmed = $type == 1 ? 1 : 3;
        $withdraw->save();

        return redirect('home'); 
    }
}
