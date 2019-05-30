<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    public function user() {
        return $this->belongsTo("App/Models/User", "user_id");
    }

    public function projects() {
        return $this->belongsTo("App/Models/Projects", "project_id");
    }
}
