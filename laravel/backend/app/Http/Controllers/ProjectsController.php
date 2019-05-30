<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Models\Category;
use App\Models\Projects;
use Auth;

class ProjectsController extends Controller
{
    public function addProject() {
        $categories = Category::all();

        return View::make('pages.addProject')->with(compact('categories'));
    }

    public function postSave() {

        $user = Auth::user();

		\request()->validate([
			"category" => "required|numeric",
			"title" => "required|max:255",
			"intro" => "required|max:255",
			"goal" => "required|numeric",
			"end_date" => "required",
		]);

		$cat_id = request("category");
		$title = request("title");
		$intro = request("intro");
		$goal = request("goal");
        $end_date = request("end_date");
        $user_id = $user->id;

		$data = [
                "cat_id" => $cat_id,
            	"title" => $title,
                "intro" => $intro,
				"goal" => $goal,
                "end_date" => $end_date,
                "user_id" => $user_id,
        ];

		Projects::Create($data);
		
		//$clients = Client::all();
        return View::make('pages.home');
    }
}
