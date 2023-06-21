<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\DeleteTaskRequest;
use App\Models\Task;
use App\Models\Category;
use App\Models\Project;
use App\Models\Status;
use Inertia\Inertia;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Inertia::share('categories', Category::all(['id','name']) );
        Inertia::share('projects', Project::all(['id','name']) );
        Inertia::share('statuses', Status::all(['id','name']) );
        return Inertia::render('Task/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3|max:255',
            'status' => 'required|integer',//something better could be done for production
            'project' => 'required|integer',
            'category' => 'required|integer',
        ]);


        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'status_id' => $request->status,
            'category_id' => $request->category,
            'project_id' => $request->project,
            'user_id' => Auth::user()->id,

        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, Int $id)
    {
        Inertia::share('categories', Category::all(['id','name']) );
        Inertia::share('projects', Project::all(['id','name']) );
        Inertia::share('statuses', Status::all(['id','name']) );
        Inertia::share('data', Task::find($id) );
        return Inertia::render('Task/edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3|max:255',
            'status' => 'required|integer',//something better could be done for production
            'project' => 'required|integer',
            'category' => 'required|integer',
        ]);


        Task::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'description' => $request->description,
            'status_id' => $request->status,
            'category_id' => $request->category,
            'project_id' => $request->project,
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task,Int $id)
    {
        Task::find($id)->delete();
    }
}
