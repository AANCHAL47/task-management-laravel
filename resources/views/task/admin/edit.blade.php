<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full">
                        <h1 class="text-2xl font-bold mb-6 text-center">Edit Task</h1>
                
                        @if ($errors->any())
                            <div class="mb-4 text-red-600 text-sm">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                
                        <form action="{{ route('admin.task.update') }}" method="POST">
                            @csrf
                        
                            <input type="hidden" name="id" value="{{$task->id}}">
                            <div class="mb-6">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title', $task->title)" required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        
                            <div class="mb-6">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea name="description" id="description"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    rows="4" placeholder="Describe the task..." required>{{ old('description', $task->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        
                            <div class="mb-6">
                                <x-input-label for="assigned_to" :value="__('Assigned To')" />
                                <select name="assigned_to"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="">Choose...</option>
                                    @forelse($users as $user)
                                        <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @empty
                                        <option value="">Not available</option>
                                    @endforelse
                                </select>
                                <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                            </div>
                        
                            <div class="mb-6">
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Done" {{ old('status', $task->status) == 'Done' ? 'selected' : '' }}>Done</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        
                            <div class="mb-6">
                                <x-input-label for="due_date" :value="__('Due Date')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date"
                                    :value="old('due_date', $task->due_date)" required autocomplete="due_date" />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>
                        
                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Update Task
                                </button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
