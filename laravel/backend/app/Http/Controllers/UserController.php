<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Models\Projects;

use Auth;

class UserController extends Controller
{
    public function profile() {
        if(Auth::user())
        {
            $projects = Projects::where('user_id', Auth::user()->id)->get();
            return View::make('user.profile')->with(compact("projects"));
        }
        else
            return redirect('/login');
    }
}
