<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{

     public $viewInfo = [
        'pageName'=>"Service",
        'action'=>['delete','update'],
        'attribute'=>['image','title','description','created_at']
    ];


    public function get(Request $request)
    {
        if($request->method() === 'POST'){
            return json_encode([
                "viewInfo"=>$this->viewInfo,
                "data"=> CourseModel::orderBy('id','desc')->get()
            ]);
        }
        return view('admin/courses');
    }






    public function onInsert(Request $request)
    {
       return CourseModel::insert([
            'title' => $request->input('title'),
            'description'=> $request->input('description'),
            'image' => url('storage/'.explode('/', $request->file('fileKey')->store('/public'))[1]),
            'created_at' => date('Y-m-d  h:i:s')
        ]);
    }





    public function onUpdate(Request $request)
    {

        if(is_null($request->file('fileKey'))){
            return CourseModel::where('id','=',$request->input('id'))
            ->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }else{
            
             return CourseModel::where('id','=',$request->input('id'))
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
       return CourseModel::where('id','=',$request->input('id'))->delete();

    }





}
