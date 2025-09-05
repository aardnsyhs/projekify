<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/projects', function () {
        return view('projects');
    })->name('projects');
    Route::get('/projects/{project}', function (Project $project) {
        if (Auth::user()->currentTeam->id !== $project->team_id) {
            abort(403);
        }
        return view('projects.show', ['project' => $project]);
    })->name('projects.show');
});
