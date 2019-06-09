<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projectimages extends Model
{
    //
    public function projects() {
        return $this->hasOne('App\Models\Projects');
    }
}
