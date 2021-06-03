<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
   
    
    public $viewInfo = [
        'pageName'=>"Service",
        'action'=>['delete','update'],
        'attribute'=>['image','title','description','created_at']
    ];




    public function get(Request $request)
    {
        if($request->method() == "POST"){
          
            return json_encode([
                "viewInfo"=>$this->viewInfo,
                "data"=> Service::orderBy('id','desc')->get()
            ]);
        }

       
        return view('admin/services');
    }





    public function onInsert(Request $request)
    {
       return Service::insert([
            'title' => $request->input('title'),
            'description'=> $request->input('description'),
            'image' => url('storage/'.explode('/', $request->file('fileKey')->store('/public'))[1]),
            'created_at' => date('Y-m-d  h:i:s')
        ]);
    }





    public function onUpdate(Request $request)
    {

        if(is_null($request->file('fileKey'))){
            return Service::where('id','=',$request->input('id'))
            ->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }else{
            
             return Service::where('id','=',$request->input('id'))
            ->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'image'=> url('storage/'.explode('/', $request->file('fileKey')->store('/public'))[1]),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }
        
    }



    public function onDelete(Request $request)
    {
       return Service::where('id','=',$request->input('id'))->delete();

    }



}
