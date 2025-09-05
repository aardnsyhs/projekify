<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    <div class="mt-8 text-2xl">
        Create New Project
    </div>
    <div class="mt-6 text-gray-500">
        <form wire:submit.prevent="saveProject">
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Project Name</label>
                <input id="name" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                    wire:model.defer="name">
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                <textarea id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model.defer="description"></textarea>
                @error('description')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Save Project
                </button>
            </div>
        </form>
    </div>
    <div class="mt-12 text-2xl">
        Your Projects
    </div>
    <div class="mt-6">
        @forelse ($projects as $project)
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900">{{ $project->name }}</h3>
                <p class="mt-1 text-gray-600">{{ $project->description }}</p>
            </div>
        @empty
            <p class="text-gray-600">You haven't created any projects yet.</p>
        @endforelse
    </div>
</div>
