<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6 text-center">Task: {{ $task->title }}</h1>

                <div class="mb-4">
                    <p class="text-gray-600 text-sm font-medium">Description:</p>
                    <p class="text-gray-800">{{ $task->description }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-gray-600 text-sm font-medium">Assigned By:</p>
                    <p class="text-gray-800">{{ ucfirst($task->userAssignedBy->name) ?? 'N/A' }}</p>
                </div>
                
                <div class="mb-4">
                    <p class="text-gray-600 text-sm font-medium mb-1">Status:</p>
                    
                    <!-- Status badge -->
                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full
                        @if($task->status == 'Pending') bg-orange-500
                        @elseif($task->status == 'Done') bg-green-500
                        @else bg-yellow-500
                        @endif">
                        {{ ucfirst($task->status) }}
                    </span>

                    <!-- Status update form -->
                    <form action="{{ route('user.task.update.status', $task->id) }}" method="POST" class="mt-3">
                        @csrf
                        <label for="status" class="block text-sm text-gray-700 mb-1">Update Status:</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                        <button type="submit" class="mt-2 inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded hover:bg-indigo-700">
                            Update Status
                        </button>
                    </form>
                </div>

                <div class="mb-4">
                    <p class="text-gray-600 text-sm font-medium">Due Date:</p>
                    <p class="text-gray-800">{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded hover:bg-gray-700">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
