<div>
    <div class="mb-4 p-4 bg-white rounded-lg shadow">
        <form wire:submit.prevent="addNewTask">
            <input type="text" wire:model.defer="newTaskTitle" class="form-input rounded-md shadow-sm w-full"
                placeholder="Add a new task...">
            @error('newTaskTitle')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </form>
    </div>
    <div class="flex space-x-4 p-4 bg-gray-100 rounded-lg overflow-x-auto" wire:sortable-group="handleTaskDropped">
        <div class="flex-shrink-0 w-72 bg-gray-200 rounded-lg">
            <h3 class="font-bold text-lg p-3 bg-gray-300 rounded-t-lg">To Do</h3>
            <div wire:sortable-group.item-group="todo" class="p-2 space-y-2">
                @forelse ($todo as $task)
                    <div wire:sortable-group.item="{{ $task->id }}" wire:key="task-{{ $task->id }}"
                        class="p-3 bg-white rounded-md shadow cursor-grab">
                        {{ $task->title }}
                    </div>
                @empty
                    <div class="p-3 text-gray-500">No tasks here.</div>
                @endforelse
            </div>
        </div>
        <div class="flex-shrink-0 w-72 bg-gray-200 rounded-lg">
            <h3 class="font-bold text-lg p-3 bg-yellow-300 rounded-t-lg">In Progress</h3>
            <div wire:sortable-group.item-group="in_progress" class="p-2 space-y-2">
                @forelse ($in_progress as $task)
                    <div wire:sortable-group.item="{{ $task->id }}" wire:key="task-{{ $task->id }}"
                        class="p-3 bg-white rounded-md shadow cursor-grab">
                        {{ $task->title }}
                    </div>
                @empty
                    <div class="p-3 text-gray-500">No tasks here.</div>
                @endforelse
            </div>
        </div>
        <div class="flex-shrink-0 w-72 bg-gray-200 rounded-lg">
            <h3 class="font-bold text-lg p-3 bg-green-300 rounded-t-lg">Done</h3>
            <div wire:sortable-group.item-group="done" class="p-2 space-y-2">
                @forelse ($done as $task)
                    <div wire:sortable-group.item="{{ $task->id }}" wire:key="task-{{ $task->id }}"
                        class="p-3 bg-white rounded-md shadow cursor-grab">
                        {{ $task->title }}
                    </div>
                @empty
                    <div class="p-3 text-gray-500">No tasks here.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
