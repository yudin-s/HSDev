<?php

namespace App\Http\Controllers;

use App\Element;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    public function index(Request $request){
        $list = Element::all();
        return response()->json($list);
    }

    public function create(Request $request){

        $element = new Element();

        $element->save();

        return response()->json(['message'=>'Item edited', 'success'=>true]);

    }

    public function delete(Request $request){
        $element = Element::findOrFail($request->get('id'));
        $element->delete();
        return response()->json(['message'=>'Item Removed', 'success'=>true]);
    }


    /**
     *
     * Mass store list with correct sequence
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editAll(Request $request){
        $element = Element::findOrFail($request->get('id'));

        $element->fill($request->all());
        $element->save();

        return response()->json(['message'=>'Item edited', 'success'=>true]);

    }
}
