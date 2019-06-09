<?php

namespace App\Policies;

use App\User;
use Auth;
use App\Models\Projects;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectsPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Projects $project)
    {
        return Auth::user()->id === $project->user_id;
    }

    public function __construct()
    {
        //
    }
}
