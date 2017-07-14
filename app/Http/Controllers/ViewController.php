<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Project;
use App\Reports;
use Illuminate\Support\Facades\DB;
class ViewController extends Controller
{
    
    public function edit(){
        if(Auth::guest())
        {
            return redirect('login');
        }
        return view('edit');
        
    }
    
    public function create(){
        
        if(Auth::guest())
        {
            return redirect('login');
        }
        return view('create');
    }
    
    public function show()
    {
        
        if(Auth::guest())
        {
            return redirect('login');
        }
        
        return view('show');
    }
    
    public function dashboard()
    {
       if(Auth::user()->admin==1)
       {
           $admin_id=Auth::user()->id;
           $manage_project=Project::where('manager',$admin_id)->where('status',1)->orderBy('id','desc')->paginate(9);
           $manage_links=$manage_project->links();
           $statu=0;
           $Closed_projects=Project::where('status',$statu)->where('creator',$admin_id)->orderBy('id','desc')->paginate(9);
           $projects_pages=$Closed_projects->links();
           
           $statu=1;
           
           $self_reports=Reports::where('user_id',$admin_id)->orderBy('id','desc')->paginate(9);
           $self_reports_pages=$self_reports->links();
           $self_projects=Project::where('creator',$admin_id)->where('status',$statu)->orderBy('id','desc')->paginate(9);
           $self_projects_pages=$self_projects->links();
           $users=User::orderBy('id','asc')->paginate(9);
           $links=$users->links();
           
           $participates_projects=DB::table('enrolement')->join('projects','enrolement.project_code','projects.id')->join('users',function($join) use($admin_id){
               
               $join->on('users.id','=','enrolement.user_id')->where('enrolement.user_id',$admin_id);
               
           })->select('projects.*')->paginate(9);
           $participate_links=$participates_projects->links();
           
           
           return view('admin_dashboard')->with(compact('self_reports','self_reports_pages','Closed_projects','projects_pages','manage_project','manage_links','self_projects','self_projects_pages','users','links','participates_projects','participate_links'));
           
           
           
           
       }
        
          $admin_id=Auth::user()->id;
           $statu=1;
           $manage_project=Project::where('manager',$admin_id)->where('status',1)->orderBy('id','desc')->paginate(9);
           $manage_links=$manage_project->links();
           $statu=0;
           $Closed_projects=Project::where('status',$statu)->where('creator',$admin_id)->orderBy('id','desc')->paginate(9);
           $projects_pages=$Closed_projects->links();
           
           $statu=1;
           
           $self_reports=Reports::where('user_id',$admin_id)->orderBy('id','desc')->paginate(9);
           $self_reports_pages=$self_reports->links();
           $self_projects=Project::where('creator',$admin_id)->where('status',$statu)->orderBy('id','desc')->paginate(9);
           $self_projects_pages=$self_projects->links();
           $users=User::orderBy('id','asc')->paginate(9);
           $links=$users->links();
           
           $participates_projects=DB::table('enrolement')->join('projects','enrolement.project_code','projects.id')->join('users',function($join) use($admin_id){
               
               $join->on('users.id','=','enrolement.user_id')->where('enrolement.user_id',$admin_id)->where('projects.status',1);
               
           })->select('projects.*')->paginate(9);
           $participate_links=$participates_projects->links();
           
           return view('user_dashboard')->with(compact('self_reports','self_reports_pages','Closed_projects','projects_pages','manage_project','manage_links','self_projects','self_projects_pages','users','links','participates_projects','participate_links'));
        
    }
    
    public function profile()
    {
        
        $id=Auth::user()->id;
        
        $user=User::find($id);
        
        return view('profile')->with(compact('user'));
    }
    //
}
