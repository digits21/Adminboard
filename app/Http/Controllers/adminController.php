<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reports;
use App\User;
use App\Project;
use Illuminate\Support\Facades\DB;
use App\Enrolement;

class adminController extends Controller
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
    public function create($id)
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
        $proj_id=$request->input('id');
        $user_id=$request->input('name');
        
        $Enrole= new Enrolement();
        
        $Enrole->project_code=$proj_id;
        $Enrole->user_id=$user_id;
        $Enrole->save();
        
        return redirect()->action('ViewController@dashboard');
        
        
        
        
        
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
        
    
        
           $manage_project=Project::where('manager',$id)->where('status',1)->orderBy('id','desc')->paginate(9);
           $manage_links=$manage_project->links();
           $statu=0;
           $Closed_projects=Project::where('status',$statu)->where('creator',$id)->orderBy('id','desc')->paginate(9);
           $projects_pages=$Closed_projects->links();
           
           $statu=1;
           $user=User::find($id);
           $self_reports=Reports::where('user_id',$id)->orderBy('id','desc')->paginate(9);
           $self_reports_pages=$self_reports->links();
           $self_projects=Project::where('creator',$id)->where('status',$statu)->orderBy('id','desc')->paginate(9);
           $self_projects_pages=$self_projects->links();
           $users=User::orderBy('id','asc')->paginate(9);
           $links=$users->links();
           
           
           return view('adminview')->with(compact('self_reports','self_reports_pages','Closed_projects','projects_pages','manage_project','manage_links','self_projects','self_projects_pages','users','links','user'));
        
    
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
        
        
        $proj_id=$id;
        $users=User::pluck('name','id');
        return view('add_user')->with(compact('users','proj_id'));
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
        
        $user=Enrolement::where('user_id',$id)->get();
        foreach($user as $val)
        {
            $val->delete();
        }
        
        
        return redirect()->action('ViewController@dashboard');
        
        
        //
    }
}
