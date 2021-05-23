<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceModel;
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
                "data"=> ServiceModel::all()
            ]);
        }

        return view('admin/services');
    }

    public function onInsert()
    {
        
    }

    public function onUpdate(Request $request)
    {
        return ServiceModel::where('id','=',$request->input('id'))
        ->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'image'=>$request->input('image'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
        
    }

    public function onDelete(Request $request)
    {
       return ServiceModel::where('id','=',$request->input('id'))->delete();
        
    }
}
