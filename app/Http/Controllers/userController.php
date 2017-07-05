<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     $users=User::orderBy('id','asc')->paginate(10);
    $links=$users->links();

return view('user',compact('users','links'));   
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
