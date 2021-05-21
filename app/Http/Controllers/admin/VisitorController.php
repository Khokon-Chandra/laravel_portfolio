<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorModel;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function get()
    {
        return view('admin/visitors',['visitors'=>json_encode(VisitorModel::all())]);
    }


    public function onUpdate()
    {

    }

    public function onDelete(Request $request)
    {

        return VisitorModel::where('id','=',$request->input('id'))->delete();

    }
}
