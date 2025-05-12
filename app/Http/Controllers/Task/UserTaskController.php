<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    public function index() {
        $tasks = Task::where('assigned_to', Auth::id())->latest()->paginate(20);
        return view('task.user.index', compact('tasks'));
    }

    public function view($id) {
        $task = Task::with('userAssignedBy')->findOrFail($id);
        return view('task.user.view', compact('task'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Done',
        ]);

        $task = Task::findOrFail($id);

        // Optionally check if the user is allowed to update
        if (Auth::id() !== $task->assigned_to) {
            return back()->with('error', 'You are not allowed to update this task.');
        }

        $task->status = $request->status;
        $task->save();

        return back()->with('success', 'Task status updated successfully.');
    }




}
