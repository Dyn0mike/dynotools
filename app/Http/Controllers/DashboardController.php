<?php

namespace App\Http\Controllers;

use App\Models\Toon;
use App\Models\Moons;
use App\Models\MoonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $toons = Toon::where('user_id', '=', Auth::user()->id);
        $toons = $toons->get();
        
        $filtered = MoonRequest::with('Moon')-> where('user_id', '=', Auth::user()->id);
        $reqs = $filtered->get();
        $fmoons = Moons::where('User', '=', Auth::user()->id);
        $Umoons = $fmoons->get();


        $respond = Http::get("https://esi.evetech.net/latest/characters/93857807/?datasource=tranquility");

        //dd($respond->body());
        $corp = json_decode($respond->body());

        return view('dashboard', [
            'pub' => $corp->corporation_id,
            'toons' => $toons,
            'reqs' => $reqs,
            'Umoons' => $Umoons
        ]);
    }
}
