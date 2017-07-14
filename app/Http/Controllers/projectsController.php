<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use App\Project;
use App\User;
class projectsController extends Controller
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
        
        return redirect()->action('ViewController@dashboard');
        
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::guest())
        {
            return redirect('login');
        }
        
        return redirect()->action('createProjectController@index');
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
        $validator=Validator::make($request->all(),[
            
            'code'=>'required|string|unique:projects',
            'type'=>'required|string',
            'project_name'=>'required|string|unique:projects',
            'manager'=>'required|string',
            'content'=>'required',
            
            
            
        ]);
        if($validator->fails())
        {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $project=new Project();
        
        $dom=new \DOMDocument();
        $content=$request->input('content');
        $dom->loadHtml( mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images=$dom->getElementsByTagName('img');
        
        foreach($images as $img)
        {
            $src=$img->getAttribute('src');
            
            if(preg_match('/data:image/',$src))
            {
                
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];
				
				// Generating a random filename
				$filename = uniqid();
				$filepath = "/images/$filename.$mimetype";
                $image=Image::make($src)->encode($mimetype,100)->save(public_path($filepath));
                
                $new_src=asset($filepath);
                $img->removeAttribute('src');
                
                $img->setAttribute('src',$new_src);
                
                
                
                
                
                
                
            }
            
        }
        
        $project->content=$dom->saveHtml();
        
        $project->project_name=$request->input('project_name');
        $project->code=$request->input('code');
        $project->type=$request->input('type');
        $project->manager=$request->input('manager');
        $project->creator=Auth::user()->id;
        $project->status=1;
        $project->editions=0;
        $project->save();
        $code=$request->input('code');
        Schema::create($code, function(Blueprint $table){
            $table->increments('id');
            
            $table->string('device_code');
            $table->string('name');
            $table->string('voltage')->nullable();
            $table->string('tempeture')->nullable();
            $table->string('mathself');
            $table->string('formula_val');
            $table->integer('default_val')->default(0);
            $table->string('top_alert')->nullable();
            $table->string('top_active')->nullable();
            $table->string('down_alert')->nullable();
            $table->string('down_active')->nullable();
            $table->string('upper_limit')->nullable();
            $table->string('lower_limit')->nullable();
            $table->string('file_name');
            $table->rememberToken();
            $table->timestamps();
            
        });
        
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
        
        return view('projects')->with(compact('project','manager','users','links','id'));
        
        
        
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
        
        $project=Project::find($id);
        $users=User::pluck('name','id');
        
        return view('edit_project')->with(compact('project','users'));
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
        
        
        $validator=Validator::make($request->all(),[
            
            'code'=>'required|string|unique:projects',
            'type'=>'required|string',
            'project_name'=>'required|string|unique:projects',
            'manager'=>'required|string',
            'content'=>'required',
            
            
            
        ]);
        if($validator->fails())
        {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $project=Project::find($id);
        $old_code=$project->code;
        $dom=new \DOMDocument();
        $content=$request->input('content');
        $dom->loadHtml( mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images=$dom->getElementsByTagName('img');
        
        foreach($images as $img)
        {
            $src=$img->getAttribute('src');
            
            if(preg_match('/data:image/',$src))
            {
                
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];
				
				// Generating a random filename
				$filename = uniqid();
				$filepath = "/images/$filename.$mimetype";
                $image=Image::make($src)->encode($mimetype,100)->save(public_path($filepath));
                
                $new_src=asset($filepath);
                $img->removeAttribute('src');
                
                $img->setAttribute('src',$new_src);
                
                
                
                
                
                
                
            }
            
        }
        
        $project->content=$dom->saveHtml();
        
        $project->project_name=$request->input('project_name');
        $project->code=$request->input('code');
        $project->type=$request->input('type');
        $project->manager=$request->input('manager');
        $project->creator=Auth::user()->id;
        $project->status=1;
        $project->editions=0;
        $project->save();
        Schema::dropIfExists($old_code);
        $newcode=$request->input('code');
        
        Schema::create($newcode, function(Blueprint $table){
            $table->increments('id');
            
            $table->string('device_code');
            $table->string('name');
            $table->string('voltage')->nullable();
            $table->string('tempeture')->nullable();
            $table->string('mathself');
            $table->string('formula_val');
            $table->integer('default_val')->default(0);
            $table->string('top_alert')->nullable();
            $table->string('top_active')->nullable();
            $table->string('down_alert')->nullable();
            $table->string('down_active')->nullable();
            $table->string('upper_limit')->nullable();
            $table->string('lower_limit')->nullable();
            $table->string('file_name');
            $table->rememberToken();
            $table->timestamps();
            
        });
        
        return redirect()->action('ViewController@dashboard');
        
        
        
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
        
        $project=Project::find($id);
        $project->status=0;
        $project->save();
        return redirect()->action('ViewController@dashboard');
        
        //
    }
}
