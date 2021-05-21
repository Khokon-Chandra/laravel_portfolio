<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CourseModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function get()
    {
        return view('admin/courses',['courses'=>CourseModel::all()]);
    }

    public function onInsert()
    {
        
    }

    public function onUpdate()
    {

    }

    public function onDelete()
    {

    }
}
