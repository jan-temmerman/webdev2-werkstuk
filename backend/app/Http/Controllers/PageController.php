<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function home() {
        return View::make('pages.home');
    }

    public function projects() {
        return View::make('pages.projects');
    }

    public function tech() {
        $projects = Projects::where("cat_id", 1);
        return View::make('pages.projects')->with("projects");
    }
}
