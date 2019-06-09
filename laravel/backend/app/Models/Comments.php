<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = 
    [   
        'content',
        'project_id',
        'user_id',
        'date'
    ];

    public function user() {
        return $this->belongsTo("App/User", "user_id");
    }

    public function projects() {
        return $this->belongsTo("App/Models/Projects", "project_id");
    }
}
