<?php

namespace App\Http\Controllers\Auth;

use App\Models\Toon;
use Illuminate\Http\Request;
//use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Contracts\Factory as Socialite;


class ProviderController extends Controller
{
    const scopes = [
        'publicData'
    ]; //define your scopes here 
    // removed these to make public only , 'esi-corporations.read_structures.v1', 'esi-characters.read_corporation_roles.v1', 'esi-characters.read_notifications.v1',
    //'esi-assets.read_corporation_assets.v1', 'esi-industry.read_corporation_mining.v1'
    public function redirect(Socialite $social)
    {
        return $social->driver('eveonline')
            ->scopes(self::scopes)
            ->redirect();
    }


    public function callback(Socialite $social)
    {
        $eve_data = $social->driver('eveonline')->scopes(self::scopes)
            ->user();
        $entireTable = Toon::all();
        

        $respond = Http::get("https://esi.evetech.net/latest/characters/{$eve_data->character_id}/?datasource=tranquility");
        $pub = json_decode($respond->getBody());


        $t2 = Toon::where('chid', $eve_data->character_id)->first();
        if(empty($pub->alliance_id)){
            Toon::updateOrcreate(
                ['chid' => $eve_data->character_id],
                [
                    'character_name' => $eve_data->character_name,
                    'user_id' => Auth::user()->id,
                    'corporation_id' => $pub->corporation_id,
                    'corporation_name' => $pub->corporation_id,
                    'alliance_id' => 1000000001,
                    'access_token' => $eve_data->token,
                    'refresh_token' => $eve_data->refreshToken,
                    'expires' => ("1")
                ]
            );
        }else{
            Toon::updateOrcreate(
                ['chid' => $eve_data->character_id],
                [
                    'character_name' => $eve_data->character_name,
                    'user_id' => Auth::user()->id,
                    'corporation_id' => $pub->corporation_id,
                    'corporation_name' => $pub->corporation_id,
                    'alliance_id' => $pub->alliance_id,
                    'access_token' => $eve_data->token,
                    'refresh_token' => $eve_data->refreshToken,
                    'expires' => ("1")
                ]
            );
        }

        //dd($pub);
        


        Toon::updateOrcreate(
            ['chid' => $eve_data->character_id],
            [
                'character_name' => $eve_data->character_name,
                'user_id' => Auth::user()->id,
                'corporation_id' => $pub->corporation_id,
                'corporation_name' => $pub->corporation_id,
                
                'access_token' => $eve_data->token,
                'refresh_token' => $eve_data->refreshToken,
                'expires' => ("1")
            ]
        );


        //$t2 = Toon::findOrCreate($eve_data);
        //$toon = new Toon;
        //dd($eve_data->character_id,$eve_data);
        $redirect = session()->pull('_redirect', '/');
        session()->forget('_redirect');
        //dd(Auth::user()->id);
        //return view('dashboard');
        return redirect('dashboard');
    }
}
