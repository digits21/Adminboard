<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Reports;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ReportController extends Controller
{
    //
    
    public function index()
    {
        $id=Auth::user()->id;
        $reports=DB::table('users')->join('reports',function($join) use($id){
            
            $join->on('reports.user_id','=','users.id')->where('users.id',$id);
            
        })->orderBy('reports.id','desc')->select('reports.*','users.name')->paginate(10);
        
        $links=$reports->links();
        
        
        
        //var_dump($reports);
        return view('user_reports')->with(compact('reports','links'))->withOk('Report sent Successfully');
        
    }
}
