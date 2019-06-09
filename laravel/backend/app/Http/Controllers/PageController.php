<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Projects;
use App\Models\Projectimages;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function home() {
        $latestProject = Projects::orderBy('created_at', 'desc')->first();
        $progress = $latestProject->budget / $latestProject->goal * 100;

        $now = date("Y-m-d"); // or your date as well
        $end_date = $latestProject->end_date;
        $datediff = date_diff(new DateTime($now),new DateTime($end_date));

        return View::make('pages.home')->with(compact("latestProject", "projectImage", "progress", "datediff"));
    }

    public function projects() {
        $projects = Projects::orderBy('created_at', 'desc')->take(3)->get();
        $categories = Category::all();
        return View::make('pages.projects')->with(compact("projects", "categories"));
    }

    public function tech() {
        $projects = Projects::where("cat_id", 1);
        return View::make('pages.projects')->with("projects");
    }

    public function policy() {
        return View::make('pages.policy');
    }
}
