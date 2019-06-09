<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Projects;
use App\Models\Rewards;
use App\Models\Projectimages;
use App\Models\Comments;
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

    public function about() {

        return View::make('pages.about');
    }

    public function contact() {

        return View::make('pages.contact');
    }

    public function projects() {
        $projects = Projects::orderBy('created_at', 'desc')->take(3)->get();
        $categories = Category::all();
        return View::make('pages.projects')->with(compact("projects", "categories"));
    }

    public function catProjects($category_name) {
        $category = Category::where('name','=', $category_name)->firstOrFail();
        $projects = Projects::where('cat_id', $category->id)->paginate(9);
        $name = strtoupper($category_name);
        return View::make('pages.projectsCat')->with(compact("projects", "categories", "name"));
    }

    public function projectDetail($project_id) {
        $project = Projects::find($project_id);
        if($project)
        {
            $rewards = Rewards::where('project_id', $project_id)->get();
            $title = strtoupper($project->title);
            $comments = Comments::where('project_id', $project_id)->get();

            $progress = $project->budget / $project->goal * 100;

            $now = date("Y-m-d"); // or your date as well
            $end_date = $project->end_date;
            $datediff = date_diff(new DateTime($now),new DateTime($end_date));

            return View::make('pages.projectDetail')->with(compact("project", "title", "rewards", "progress", "datediff", "comments"));
        }
    }

    public function policy() {
        return View::make('pages.policy');
    }
}
