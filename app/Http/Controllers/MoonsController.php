<?php

namespace App\Http\Controllers;

use App\Models\Toon;
use App\Models\Moons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MoonsController extends Controller
{
    public function index()
    {
        //$data Moons::all();
        try{
            $toons = Toon::where('user_id', '=', Auth::user()->id)->where('alliance_id', '=','99005338')->firstOrFail();
        }catch(ModelNotFoundException $exception){
            return Redirect::to('dashboard')->with('message', $exception->getMessage());
        }
        $data = Moons::where('Available', "Yes")->where(function ($query) {
                $query->where('region', "The Kalevala Expanse")->orwhere('region', "Perrigen Falls");
            })->orderByDesc('Rent')->paginate(24);
        //dd($data);
        return view('moons.index', ['moonst' => $data]);
    }
    public function filterMoons(Request $request)
    {
        if ($request->input('moon') == 'TKEPF16') {
            $data = Moons::where('Available', "Yes")->where('rare', "16")
                ->where(function ($query) {
                    $query->where('region', "The Kalevala Expanse")->orwhere('region', "Perrigen Falls");
                })->orderByDesc('Rent')->paginate(24);
            return view('moons.index', ['moonst' => $data]);
        }
        if ($request->input('moon') == 'TKEPF8') {
            $data = Moons::where('Available', "Yes")->where(function ($query1) {
                $query1->where('rare', "4")->orwhere('rare', "8");
            })
                ->where(function ($query) {
                    $query->where('region', "The Kalevala Expanse")->orwhere('region', "Perrigen Falls");
                })->orderByDesc('Rent')->paginate(24);
            return view('moons.index', ['moonst' => $data]);
        }
        if ($request->input('moon') == 'im64') {
            $data = Moons::where('Available', "Yes")->where(function ($query) {
                $query->where('rare', "64")->orwhere('rare', "32");
            })
                ->where('region', "Insmother")->orderByDesc('Rent')->paginate(24);
            return view('moons.index', ['moonst' => $data]);
        }
        if ($request->input('moon') == 'im16') {
            $data = Moons::where('Available', "Yes")->where('rare', "16")
                ->where('region', "Insmother")->orderByDesc('Rent')->paginate(24);
            return view('moons.index', ['moonst' => $data]);
        }
    }
}
