<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Transaction;
use App\Balance;
use App\TopUp;
use App\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class UserController extends Controller 
{
    public $successStatus = 200;

    public function transfer(Request $request){
        $sender = Auth::user();

        $input = $request->all(); 
        $to = $input["to_id"];
        $amount = $input["amount"];

        if($amount > $sender->balance->balance) {
            return response()->json(['message'=>'Failed transfer, insufficient balance.'], 400); 
        }

        $transaction = Transaction::create(["amount" => $amount, 'tx_type_id' => 2]);
        $sender->transactions()->attach($transaction, ['to_id' => $to]);
        
        // Update Sender Balance
        $sender->balance()->decrement('balance', $amount);

        // Update Recipient Balance
        User::find($to)->balance()->increment('balance', $amount);

        return response()->json(['message'=>'Success transfer','to_id'=>$to,'amount'=>$amount], 200); 
    }

    public function request_topup(Request $request){
        $input = $request->all();
        $create = [
            "request_balance" => $input['request_balance'],
            "user_id" => Auth::user()->id,
            "confirmed" => false,
        ];
        $topup = TopUp::create($create);
        $data["balance"] = $input['request_balance'];
        return response()->json(['message'=>'Success Request Top Up','data'=> $data], 200);
    }

    public function request_withdraw(Request $request){
        $input = $request->all();
        $requestBalance = $input['request_balance'];

        $user = Auth::user();
        $userBalance = $user->balance();
        $getBalance = $userBalance->first();
        $currentBalance = $getBalance['balance'];

        if($requestBalance > $currentBalance)  {
            return response()->json(['message'=>'Cannot withdraw, insufficient fund.', 'success' => false], 400);
        }

        $create = [
            "request_balance" => $requestBalance,
            "user_id" => $user->id,
            "confirmed" => false,
        ];
        $withdraw = Withdraw::create($create);
        $data["balance"] = $requestBalance;

        return response()->json(['message'=>'Success Request Withdraw','data'=> $data, 'success' => true], 200);
    }
    
    public function topup(Request $request){
        // $to = $request->input('to_id');
        $email = $request->input('to_email');
        $user = User::where('email', $email)->first();
        $to = $user->id;
        
        $input = $request->all(); 
        $amount = $input["amount"];
        
        // TOPUP RESULT user_id and to_id will be the same
        $transaction = Transaction::create(["amount" => $amount, 'tx_type_id' => 1]);
        $user->transactions()->attach($transaction, ['to_id' => $to]);
        $user->balance()->increment('balance', $amount);

        $data = [
            'to_id'=>$to,
            'amount'=>$amount
        ];

        return response()->json(['message'=>'Success Top up','data'=> $data], 200); 
    }

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function history(){ 
        $user = Auth::user();
        $history = $user->history();

        // $trans = Transaction::find(1);
        // print($trans->amount);
        // print($trans->transactionTypes->type);

        return response()->json(['message'=>'Success get history', 'data'=> $history], 200); 
    }

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->api_token;
            return response()->json(['success' => 'Success login', 'data'=> $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $input['role_id'] = $input['role_id'] || 2; // USER
        $input['api_token'] = Str::random(60);
        $user = User::create($input); 
        $success['token'] =  $user->api_token; 
        $success['name'] =  $user->name;

        $balance['user_id'] = $user->id;
        $balance['balance'] = 0;
        Balance::create($balance);

        return response()->json(['success'=>'Success Register', 'data' => $success], $this->successStatus); 
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details(Request $request) 
    { 
        $email = $request->email ? $request->email : Auth::user()->email;
        $user = User::where('email',$email)->with('balance')->first();
        $data['id'] = $user->id;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['balance'] = $user->balance->balance;
        $data['role_id'] = $user->role_id;

        return response()->json(['success' => 'Success get details', 'data' => $data], $this->successStatus); 
    } 

    public function logout(Request $request)
    {
       return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}