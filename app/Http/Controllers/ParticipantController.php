<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $project=DB::table('projects')->join('users',function($join) use($id){
            $join->on('users.id','=','projects.creator')->where('projects.id',$id);
            
        })->select('users.name','users.email','users.id','projects.*')->get();
        
        $manager=DB::table('projects')->join('users', function($query) use($id){
            
            $query->on('users.id','=','projects.manager')->where('projects.id',$id);
        })->select('users.name','users.id')->get();
        
        $users=DB::table('users')->join('enrolement',function($query) use($id){
            
            $query->on('enrolement.user_id','=','users.id')->where('enrolement.project_code',$id);
        })->select('users.name','users.id')->paginate(9);
        
        $links=$users->links();
        
        return view('participant')->with(compact('project','manager','users','links'));
        
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
        //
    }
}
