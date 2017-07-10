<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('create')''
    }
    
    public function show()
    {
        
        if(Auth::guest())
        {
            return redirect('login');
        }
        
        return view('show');
    }
    //
}
