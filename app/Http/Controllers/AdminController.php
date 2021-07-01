<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boxes;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxes = Boxes::orderby('sequence')->get();
        return view('admin.admin',compact('boxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $style = "";
        foreach($request->style as $key => $value){
            $style .= $value ? "{$key}:{$value};" : "";
        }
        $request->merge(['style' => $style]);
        $box = Boxes::find($request->id);
        $box->update($request->except('_token','id','sequence'));

        return back()->with('alert','Updated');
    }

    public function updateSequence(Request $request){
        
        foreach($request->seq as $key => $value){
            $box = Boxes::find($value)->update(['sequence'=>$key]);
        }
    }


}
