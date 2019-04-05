<?php

namespace App\Http\Controllers;

use App\Mail\Add;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AddController extends Controller
{
    public function sendAdd()
    {
        Mail::to("temmjan@gmail.com", "Jan Temmerman")->send(new Add());
        Mail::to("frederick.roegiers@arteveldehs.be", "Frederick Roegiers")->send(new Add());
        return view('emails.add');
    }
}
