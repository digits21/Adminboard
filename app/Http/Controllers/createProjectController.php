<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class createProjectController extends Controller
{
    
    public function index()
    {
        $users=User::pluck('name','id');
        
        //var_dump($users);
        
        return view('create_project')->with(compact('users'));
        
        
    }
    //
}
