<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\Projects;
use App\Models\Rewards;
use App\Models\Projectimages;
use App\Models\Comments;
use App\User;
use Auth;

class ProjectsController extends Controller
{
	public function addImage() {
		if(Auth::user())
			return View::make('uploader.image');
		else
            return redirect('/login');
	}

    public function addProject(Projects $project) {
        $categories = Category::all();
		if(Auth::user())
			return View::make('pages.addProject')->with(compact('categories', 'project'));
		else
            return redirect('/login');
    }
    
    public function addReward(Rewards $reward) {
        $categories = Category::all();
		if(Auth::user())
			return View::make('uploader.rewards')->with(compact('categories', 'reward'));
		else
            return redirect('/login');
	}
	
	public function postUpload(Request $request) {

        $project = Projects::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();

        // validatie-regels
        $rules = [
            'file'          => 'required',
            'file.*'        => 'image|mimes:jpeg,png,gif,svg,jpg|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with(
                    [
                        'notification' => 'danger',
                        'message' => 'Er ging iets mis :-('
                    ]
                );
        }

        if($request->hasFile('file')) {

            // folder van de afbeelding(en)
            $directory = '/project-' . $project->id;

            foreach($request->file('file') as $image) {

                $name = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();

                $filename = pathinfo($name, PATHINFO_FILENAME) . '-' . uniqid(5) . '.' . $extension;

                $image->storeAs($directory, $filename, 'public');

                $this->storeImageToDatabase($project->id, $filename, 'storage' . $directory);
            }

            return redirect('/add_project/add_rewards');
        }
	}

    public function postSave() {

        $user = Auth::user();

		\request()->validate([
			"category" => "required|numeric",
			"title" => "required|max:255",
			"intro" => "required",
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
		
        return View::make('uploader.image');
    }
    
    public function postRewardSave() {

        $project = Projects::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();

		\request()->validate([
			"name" => "required|max:255",
			"intro" => "required",
			"at_amount" => "required|numeric",
		]);

		$name = request("name");
		$intro = request("intro");
		$at_amount = request("at_amount");
        $project_id = $project->id;

		$data = [
            	"name" => $name,
                "intro" => $intro,
				"at_amount" => $at_amount,
                "project_id" => $project_id,
        ];

		Rewards::Create($data);
        
        return redirect('/profile');
    }
	
	private function storeImageToDatabase( $project_id, $filename, $filepath ) {

        $image = new Projectimages();

        $image->project_id = $project_id;
        $image->title = $filename;
        $image->image = $filepath;

        $image->save();
    }

    public function fundProject(Request $request, $project_id) {
        $errormsg = "Insufficient credits, You can buy credits on the profile page!";

        $ratio = env('CREDIT_RATIO');

        $user = Auth::user();
        if($user->credits >= $request->amount)
        {
            $rewards = Rewards::where('project_id', $project_id)->get();
            foreach($rewards as $reward) 
            {
                if($request->amount >= $reward->at_amount)
                    app('App\Http\Controllers\MailController')->sendReward($reward->name, $user);
            }

            User::where('id', $user->id)->decrement('credits', $request->amount);

            //Admin
            User::where('id', 2)->increment('credits', round($request->amount*0.1, 0)); 

            Projects::where('id', $project_id)->increment('budget', round($request->amount*$ratio*0.9, 0));

            return redirect('/project/' . $project_id);
        }
        else
            return redirect('/project/' . $project_id)->with($errormsg);
    }

    public function commentProject($project_id) {

        $user = Auth::user();

        \request()->validate([
            "comment" => "required",
        ]);

        $comment = request("comment");
        $user_id = $user->id;

        $data = [
                "content" => $comment,
                "user_id" => $user_id,
                "project_id" => $project_id,
                "date" =>  date('Y-m-d H:i:s'),
        ];

        Comments::Create($data);
        
        return redirect('/project/' . $project_id);
    }

    public function destroy(Request $request, Projects $project)
    {
        $this->authorize('destroy', $project);

        $project->delete();

        return redirect('/profile');
    }
}
