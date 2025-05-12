<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTaskController extends Controller
{
    public function index() {
        $tasks = Task::with('user')->latest()->paginate(20);
        return view('task.admin.index', compact('tasks'));
    }

    public function create() {
        $users = User::where('role', 'user')->latest()->get();
        return view('task.admin.add', compact('users'));
    }

    public function store(Request $request) {
        // ✅ Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:users,id',
            'status' => 'required|in:Pending,In Progress,Done', // adjust options as needed
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        // ✅ Create task and assign the current authenticated user as the creator
        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'assigned_to' => $validated['assigned_to'],     // Assigned to another user
            'status' => $validated['status'],
            'due_date' => $validated['due_date'],
            'created_by' => Auth::id(),                         // Created by current user
        ]);

        return redirect()->route('admin.task')->with('success', 'Task created successfully!');
    }

    public function edit($id) {
        $task = Task::with('user')->find($id);
        $users = User::where('role', 'user')->latest()->get();

        return view('task.admin.edit', compact('task','users'));
    }

    public function update(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Pending,In Progress,Done',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $task->update($request->only('title', 'description', 'status', 'due_date', 'assigned_to'));

        return redirect()->route('admin.task')->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.task')->with('success', 'Task deleted successfully!');
    }


}
