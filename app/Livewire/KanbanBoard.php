<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Events\TaskMoved;

class KanbanBoard extends Component
{
    public Project $project;
    public $newTaskTitle;

    protected $rules = [
        'newTaskTitle' => 'required|string|max:255',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function addNewTask()
    {
        $this->validate();

        $this->project->tasks()->create([
            'title' => $this->newTaskTitle,
            'status' => 'todo',
        ]);

        $this->reset('newTaskTitle');
    }

    public function handleTaskDropped($groups)
    {
        foreach ($groups as $group) {
            $status = $group['value'] ?? null;
            $items = array_values($group['items'] ?? []);
            if (!$status)
                continue;

            foreach ($items as $item) {
                $taskId = (int) ($item['value'] ?? $item['id'] ?? 0);
                if ($taskId > 0) {
                    $task = $this->project->tasks()->whereKey($taskId)->first();
                    if ($task && $task->status !== $status) {
                        $task->update(['status' => $status]);
                        // event(new TaskMoved($this->project, $task->fresh()));
                        TaskMoved::dispatch($this->project, $task->fresh());
                    }
                }
            }
        }

        $this->project->refresh();
    }

    public function render()
    {
        $tasks = $this->project->tasks()->get()->groupBy('status');

        return view('livewire.kanban-board', [
            'todo' => $tasks->get('todo', collect()),
            'in_progress' => $tasks->get('in_progress', collect()),
            'done' => $tasks->get('done', collect()),
        ]);
    }

    public function getListeners()
    {
        return [
            "echo-private:project.{$this->project->id},TaskMoved" => '$refresh',
        ];
    }

}
