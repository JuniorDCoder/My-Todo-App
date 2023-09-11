<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::where('user_id', Auth::user()->id);
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:15|string',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->user_id = Auth::user()->id;

        $category->save();

        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:15|string',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;

        $category->save();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $category = Category::findOrFail($id);
        $tasks = Task::where('category_id', $id);

        $category->destroy();
        foreach ($tasks as $task) {
            $task->destroy();
        }
    }
}
