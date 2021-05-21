<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectModel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function get()
    {
        return view('admin/projects',['projects'=>ProjectModel::all()]);
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
