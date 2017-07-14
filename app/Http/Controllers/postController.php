<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Reports;
use Purifier;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
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
                                      'body'=>'required|',
                                       
                                      
                                      
                                  ]);
        if($validator->fails())
        {
            $message="The files are not accepted for now ";
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $reports=new Reports();
        
        $reports->title=$request->input('title');
        
        
        
        $description=$request->input('body');
        
        $dom=new \DOMDocument();
        
        $dom->loadHtml( mb_convert_encoding($description, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

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
        
        
        $reports->description=$dom->saveHtml();
        
        
        $reports->user_id=Auth::user()->id;
        $reports->save();
        
        return redirect()->action('ViewController@dashboard');
        
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
            'body'=>'required',
        ]);
        if($validator->fails())
        {
            
            return redirect()->back()->withErrors()->withInput();
        }
        $id=Auth::user()->id;
        $report->title=$request->input('title');
        $description=$request->input('body');
        
        $dom=new \DOMDocument();
        
        $dom->loadHtml( mb_convert_encoding($description, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

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
        
          //echo $report->description;
        $report->description=$dom->saveHtml();
        $report->user_id=$id;
        $report->save();
        
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
        
        $report=Reports::find($id);
        
        $report->delete();
        
        return redirect()->back();
        //
    }
    
    
}
