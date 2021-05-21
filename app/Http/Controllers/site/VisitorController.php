<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\VisitorModel;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    
    static function visitorTrack()
    {
        
        date_default_timezone_set('Asia/Dhaka');
        $ipAddress    = $_SERVER['REMOTE_ADDR'];
        $visited_date = date('Y-m-d H:i:s');
        VisitorModel::insert([
            'ip_address'=>$ipAddress,
            'created_at'=>$visited_date
        ]);
        
    }
}
