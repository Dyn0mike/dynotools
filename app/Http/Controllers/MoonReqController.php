<?php

namespace App\Http\Controllers;

use App\Models\Moons;
use App\Models\MoonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoonReqController extends Controller
{
    public function show(int $id){
        $data = Moons::firstWhere('id',$id);
        //dd($data);
        return view('moons.mReq',['mReq'=>$data]);
    }

    public function store(int $id){
        MoonRequest::create(
            [
                'user_id' => Auth::user()->id,
                'moon_id' => $id
            ]

        );
        return redirect()->route('dashboard');
    }
}
