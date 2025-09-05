<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Project;

Broadcast::channel('project.{project}', function ($user, Project $project) {
    return $user->belongsToTeam($project->team);
});
