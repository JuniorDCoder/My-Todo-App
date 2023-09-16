<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->get();

        return view('tasks.all_tasks', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->get();

        $categories = Category::where('user_id', $user->id)->get();
        return view('tasks.create', ['tasks' => $tasks, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
            'due_date' => 'required|date',
        ]);

        // Create a new task
        $task = new Task();
        $task->title = $validatedData['title'];
        $task->user_id = Auth::user()->id;
        $task->description = $validatedData['description'];
        $task->priority = $validatedData['priority'];
        $task->due_date = $validatedData['due_date'];
        $task->category_id = $validatedData['category_id'];
        $task->save();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function updateStatus(Task $task){
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, Request $request)
    {
        //
        $task->delete();
        $request->session()->flash('success', 'Task deleted successfully.');

        return redirect()->route('tasks.all');
    }
}
