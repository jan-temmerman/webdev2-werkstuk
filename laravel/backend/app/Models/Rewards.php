<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    protected $fillable = 
        [   
            'name',
            'intro',
            'at_amount',
            'project_id',
        ];
}
