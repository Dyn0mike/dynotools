<?php

namespace App\Http\Controllers;

use App\Models\Moons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class AdminController extends Controller
{
    public function index(){
        //$data = Moons::firstWhere('id',$id);
        //dd($data);
        return view('admin');
    }
    public function reprice(){
        //coment out if repricing.
        $this->reworth();
        exit();
        
        $allmoons = Moons::all();
        $m3 = DB::table('ore_config')->where('key', 'm3Phour')->pluck('value')->toArray();
        $unit = $m3[0] / 10;
        
        foreach($allmoons as $moon){
            $o1 = $moon->Ore1;
            $o2 = $moon->Ore2;
            $o3 = $moon->Ore3;
            $o4 = $moon->Ore4;
            $p1 = $moon->p1 / 100;
            $p2 = $moon->p2 / 100;
            $p3 = $moon->p3 / 100;
            $p4 = $moon->p4 / 100;
            $pr1 = DB::table('ore_config')->where('key', $o1)->pluck('value')->toArray();
            $pr2 = DB::table('ore_config')->where('key', $o2)->pluck('value')->toArray();
            $pr3 = DB::table('ore_config')->where('key', $o3)->pluck('value')->toArray();
            $pr4 = DB::table('ore_config')->where('key', $o4)->pluck('value')->toArray();
            //(Ore price * units per hour * hours in 30 days.) * %
            if(isset($pr1) AND isset($p1)AND !empty($pr1)){ 
                $moon->H1Worth = ($pr1[0] * $unit * 720) * $p1;}

            if(isset($pr2) AND isset($p2)AND !empty($pr2)) {
                $moon->H2Worth = ($pr2[0] * $unit * 720) * $p2;}

            if(isset($pr3) AND isset($p3) AND !empty($pr3)){
                $moon->H3Worth = ($pr3[0] * $unit * 720) * $p3;}

            if(isset($pr4) AND isset($p4)AND !empty($pr4)) {
                $moon->H4Worth = ($pr4[0] * $unit * 720) * $p4;}
            $moon->save();
            //dd($o1,$pr3, $m3, $moon);

        }

    }
    public function reworth(){
        //if r16 or above

        $allmoons = Moons::all();

        foreach($allmoons as $moon){
            $r16 = True;
            if($moon->rare == "4" || $moon->rare == "8")$r16 = False;
            if($r16 == false){
                $moon->Rent = ($moon->H1Worth + $moon->H2Worth + $moon->H3Worth + $moon->H4Worth) * 0.002;
            }
            if($r16 == True){
                $tempworth = 0;
                if($moon->harvest1_rarity == "exceptional" || $moon->harvest1_rarity == "rare"){
                    $tempworth = ($tempworth + $moon->H1Worth) * .10;
                }
                if($moon->harvest1_rarity == "uncommon"){
                    $tempworth = ($tempworth + $moon->H1Worth) * .075;
                }
                if($moon->harvest2_rarity == "exceptional" || $moon->harvest2_rarity == "rare"){
                    $tempworth = ($tempworth + $moon->H2Worth) * .10;
                }
                if($moon->harvest2_rarity == "uncommon"){
                    $tempworth = ($tempworth + $moon->H2Worth) * .075;
                }
                if($moon->harvest3_rarity == "exceptional" || $moon->harvest3_rarity == "rare"){
                    $tempworth = ($tempworth + $moon->H3Worth) * .10;
                }
                if($moon->harvest3_rarity == "uncommon"){
                    $tempworth = ($tempworth + $moon->H3Worth) * .075;
                }
                if($moon->harvest4_rarity == "exceptional" || $moon->harvest4_rarity == "rare"){
                    $tempworth = ($tempworth + $moon->H4Worth) * .10;
                }
                if($moon->harvest4_rarity == "uncommon"){
                    $tempworth = ($tempworth + $moon->H4Worth) * .075;
                }
                $moon->Rent = round($tempworth,-7);
            }
            $moon->save();
        }
        

    }
}
