<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Reports;
use Purifier;
use Illuminate\Support\Facades\Auth;
class postController extends Controller
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
        
        return view('chat');
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
        
        $validator=Validator::make($request->all(),
                                  
                                  [
                                      'title'=>'required|string|max:255',
                                      'body'=>'required|string|',
                                       
                                      
                                      
                                  ]);
        if($validator->fails())
        {
            $message="The files are not accepted for now ";
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $reports=new Reports();
        
        $reports->title=$request->input('title');
        
        $description=Purifier::clean($request->input('body'));
        $reports->description=$description;
        
        /*if($request->has('files'))
        {
            
            //var_dump($request->all());
            echo $image;
            
            /*$way=public_path('images');
            $imageName=$image->getClientOriginalName();
            
            $image->move($way,$imageName);
            
            $reports->image=$imageName;
            
            
            
            
        }*/
        $reports->user_id=Auth::user()->id;
        $reports->save();
        
        return redirect()->action('ReportController@index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report=Reports::find($id);
        
        return view('single_report')->with(compact('report'));
        
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
        $report=Reports::find($id);
        
        return view('edit_report')->with(compact('report'));
        
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
        $report=Reports::find($id);
        
        $validator=Validator::make($request->all(),[
            
            
            'title'=>'required|string',
            'body'=>'required|string',
        ]);
        if($validator->fails())
        {
            
            return redirect()->back()->withErrors()->withInput();
        }
        $id=Auth::user()->id;
        $report->title=$request->input('title');
        $report->description=$request->input('body');
        $report->user_id=$id;
        $report->save();
        
        return redirect()->back()->withOk('Report modified succesfully');
        
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
        
        $report=Reports::find($id);
        
        $report->delete();
        
        return redirect()->back();
        //
    }
    
    
}
