<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    //
    protected $fillable = 
        [   
            'cat_id',
            'title',
            'intro',
            'goal',
            'end_date', 
            'user_id'
        ];

    public function user() {
        return $this->belongsTo("App/Models/User", "user_id");
    }

    public function category() {
        return $this->hasOne("App/Models/Category", "cat_id");
    }

    public function projectimages() {
        return $this->hasMany('App\Models\Projectimages', 'project_id');
    }
}
