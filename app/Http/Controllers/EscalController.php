<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Toon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EscalController extends Controller
{

        public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        try{
            $toons = Toon::where('user_id', '=', Auth::user()->id)->where('alliance_id', '=','99005338')->firstOrFail();
        }catch(ModelNotFoundException $exception){
            return Redirect::to('dashboard')->with('message', $exception->getMessage());
        }
        
        //$toons = $toons->get();
        //dd($toons);
        $buys = Buy::all();



        


        return view('escal.escal', [
            'buys' => $buys,
            'user' => Auth::user()->id
        ]);

    }
}
