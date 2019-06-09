<?php

namespace App\Http\Controllers;

use App\Mail\Add;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendReward($rewardName, $user)
    {
        Mail::to("temmjan@gmail.com", "Jan Temmerman")->send(new Add());
    }
}
