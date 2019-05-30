<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gifts extends Model
{
    //
    public function user() {
        return $this->hasOne("App/Models/User", "user_id");
    }

    public function projects() {
        return $this->hasOne("App/Models/Projects", "project_id");
    }

    public function rewards() {
        return $this->hasOne("App/Models/Rewards", "reward_id");
    }
}
