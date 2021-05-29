<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorModel;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public $viewInfo = [
        'pageName'=>"Visitor",
        'action'=>['delete'],
        'attribute'=>['image','title','description','created_at']
    ];




    public function get(Request $request)
    {
        if($request->method() == "POST"){
          
            return json_encode([
                "viewInfo"=>$this->viewInfo,
                "data"=> VisitorModel::all()
            ]);
        }

        return view('admin/services');
    }


    public function onUpdate()
    {

    }

    public function onDelete(Request $request)
    {

        return VisitorModel::where('id','=',$request->input('id'))->delete();

    }
}
