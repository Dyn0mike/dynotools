<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Toon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BuyController extends Controller
{
    public function index()
    {
        try{
            $toons = Toon::where('user_id', '=', Auth::user()->id)->where('alliance_id', '=','99005338')->firstOrFail();
        }catch(ModelNotFoundException $exception){
            return Redirect::to('dashboard')->with('message', $exception->getMessage());
        }
        return view('escal.buy');

    } 
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|max:30',
            'discord' => 'required|max:30',
            'region' => 'required|integer|max:10',
            'length' => 'required|integer|max:10',
            'type' => 'required|integer|max:10',
            'quantity' => 'required|integer|gt:0|max:99',
            'price' => 'required|integer|gt:0|max_digits:9',
        ]);

        Buy::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'discord' => $request->discord,
            "region" => $request->region,
            "type" => $request->type,
            "length" => $request->length,
            "quantity" => $request->quantity,
            "price" => $request->price

        ]);
        return redirect()->route('escal');
    }
    public function delete(Request $request)
    {
        $buy = Buy::where('id', $request->id)->firstOrFail();
        $buy->delete();
        return redirect()->route('escal');
    }
    public function edit(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|integer|gt:0|max:99',
        ]);
        $buy = Buy::where('id', $request->id)->firstOrFail();
        $buy->quantity = $request->quantity;
        $buy->save();
        
        return redirect()->route('escal');
    }
}
