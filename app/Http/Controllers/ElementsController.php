<?php

namespace App\Http\Controllers;

use App\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class ElementsController extends Controller
{
    private  $CACHE_KEY = 'ELEMENTS_HEAP';

    //Retrive all data from cache

    public function index(Request $request){
        //$list = Element::all();
        $list = [];
        $array = json_decode(Cache::get($this->CACHE_KEY));
        if($array){
            $list = $array;
        }else{
            $list = [];
        }
        return response()->json($list);
    }

    //Store All data

    public function store(Request $request){


        $data = $request->get('elements');
        Cache::forever($this->CACHE_KEY, $data);
        return response()->json(['message'=>'Item edited', 'success'=>true]);

    }



}
