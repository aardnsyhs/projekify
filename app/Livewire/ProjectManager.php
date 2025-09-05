<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProjectManager extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function saveProject()
    {
        $this->validate();

        Auth::user()->currentTeam->projects()->create([
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', 'Project successfully created.');

        $this->reset(['name', 'description']);
    }

    public function render()
    {
        $team = Auth::user()->currentTeam;
        $projects = $team->projects()->latest()->get();

        return view('livewire.project-manager', [
            'projects' => $projects
        ]);
    }
}
