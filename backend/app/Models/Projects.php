<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    //
    public function user() {
        return $this->belongsTo("App/Models/User", "user_id");
    }

    public function category() {
        return $this->hasOne("App/Models/Category", "cat_id");
    }
}
