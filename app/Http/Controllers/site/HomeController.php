<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\ReviewModel;
use App\Models\ServiceModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __construct()
    {
        VisitorController::visitorTrack(); 
        
    }

    public function homePage()
    {
    
        $data = [
            'services' => ServiceModel::all(),
            'courses'  => CourseModel::all(),
            'projects' => ProjectModel::all(),
            'blogs'    => BlogModel::all(),
            'reviews'  => ReviewModel::all()
        ];

        return view('site/home',$data);
    }

    


}
