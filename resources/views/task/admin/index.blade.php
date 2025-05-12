<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                        <div>
                            <a href="{{ route('admin.task.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3">
                                Create Task
                            </a>
                            
                        </div>
                        <hr>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assigned To</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse ($tasks as $index => $task)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ ucfirst($task->title) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ ucfirst($task->description) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ ucfirst($task->user->name) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full
                                            @if($task->status == 'Pending') bg-orange-500 
                                            @elseif($task->status == 'Done') bg-green-500 
                                            @else bg-yellow-500 
                                            @endif">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ ucfirst($task->due_date) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.task.edit', $task->id) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-3">✏️ Edit</a>
                                        <form action="{{ route('admin.task.destroy', $task->id) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            <button onclick="return confirm('Are you sure want to delete this task?')" class="text-red-600 hover:text-red-800 font-medium">🗑️ Delete</button>
                                        </form>
                                        </td>
                                </tr>
                                @empty
                                <tr class="block md:table-row">
                                    <td colspan="4" class="p-3 text-center block md:table-cell">No tasks available.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $tasks->links() }}
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
