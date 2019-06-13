<?php

namespace App\Http\Controllers;

use App\TopUp;
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
        $topup = TopUp::with('users')->get();
        return view('home.home', ["data" => $topup]);
    }

    public function action_topup(Request $request, $type = 1, $id = null) {
        if($type == 1){
            // Do Some things
        }

        $topup = TopUp::find($id);
        $topup->confirmed = $type == 1;
        $topup->save();

        return redirect('home');
        
    }
}
