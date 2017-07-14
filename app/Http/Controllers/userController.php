<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Auth::guest())
        {
            return redirect('login');
        }
        else
        {
            return redirect()->action('ViewController@dashboard');
        }
             
        
      
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view('create');
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
                                 
                                 ['name'=>'required|string|max:60',
                                  'email'=>'required|email|max:255']
                                  
                                 
                                 );
        if ($validator->fails())
        {
            return redirect()->back()->withErrors(['error','user could not be created verify your credentials']);
        }
        
   $user=new User();
$user->name=$request->input('name');

$user->password=bcrypt($request->input('password'));
$user->email=$request->input('email');
$user->admin=($request->input('admin'))?1:0;
$user->save();

return redirect('user')->withOk("user created");

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
        $user=User::find($id);

       return view('show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    $user=User::find($id);

  return view('edit',compact('user'));        //
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
       $user=User::find($id);

     $user->name=$request->input('name');
      $user->email=$request->input('email');
    $user->password=bcrypt($request->input('password'));
  $user->admin=($request->has('admin'))?1:0;
 $user->save();

return redirect('user')->withOk("The user ".$request->input('name')." has been modified");


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
   $user=User::find($id);

  $user->delete();

return redirect()->back();
        //
    }

private function setAdmin($request)
{
  if(!$request->has('admin'))
{
  $request->merge(['admin'=>0]);
}

}
}
