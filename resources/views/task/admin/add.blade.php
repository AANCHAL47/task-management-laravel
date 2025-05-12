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
                        <h1 class="text-2xl font-bold mb-6 text-center">Create New Task</h1>
                
                        @if ($errors->any())
                            <div class="mb-4 text-red-600 text-sm">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                
                        <form action="{{ route('admin.task.store') }}" method="POST">
                            @csrf
                
                            <div class="mb-6">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                
                            <div class="mb-6">
                                <x-input-label for="description" :value="__('Description')" />

                                <textarea name="description" id="description"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    rows="4" placeholder="Describe the task..." required></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            
                            <div class="mb-6">
                                <x-input-label for="assigned_to" :value="__('Assigned To')" />
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="assigned_to" required>
                                    <option value="">Choose...</option>
                                    @forelse($users as $key => $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @empty
                                    <option value="">Not available</option>
                                    @endforelse
                                </select>
                                <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                            </div>

                            <div class="mb-6">
                                <x-input-label for="status" :value="__('Status')" />
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Done">Done</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="mb-6">
                                <x-input-label for="due_date" :value="__('Due Date')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date')" required autofocus autocomplete="due_date" required />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>
                
                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Create Task
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
