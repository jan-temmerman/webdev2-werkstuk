<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\Projects;
use App\Models\Projectimages;
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

            return redirect('/profile');
        }
	}
	
	public function postAnotherUpload(Request $request) {

        // validatie-regels
        $rules = [
            'project_id'    => 'required|numeric',
            'file'          => 'required',
            'file.*'        => 'image|mimes:jpeg,png,gif,svg,jpg|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        /*if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with(
                    [
                        'notification' => 'danger',
                        'message' => 'Er ging iets mis :-('
                    ]
                );
        }*/

        if($request->hasFile('file')) {

            // folder van de afbeelding(en)
            $directory = '/project-' . $request->project_id;

            foreach($request->file('file') as $image) {

                $name = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();

                $filename = pathinfo($name, PATHINFO_FILENAME) . '-' . uniqid(5) . '.' . $extension;

                $image->storeAs($directory, $filename, 'public');

                $this->storeImageToDatabase($request->project_id, $filename, 'storage' . $directory);
            }

            return View::make('uploader.image');
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
	
	private function storeImageToDatabase( $project_id, $filename, $filepath ) {

        $image = new Projectimages();

        $image->project_id = $project_id;
        $image->title = $filename;
        $image->image = $filepath;

        $image->save();
    }

    public function destroy(Request $request, Projects $project)
    {
        $this->authorize('destroy', $project);

        $project->delete();

        return redirect('/profile');
    }
}
