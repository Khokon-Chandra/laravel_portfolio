<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function get()
    {
        return view('admin/blogs',['blogs'=>BlogModel::all()]);
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
