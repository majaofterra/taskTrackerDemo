<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;
use App\Models\Category;
use App\Models\Status;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        Inertia::share('categories', Category::all(['id','name']) );
        Inertia::share('projects', Project::all(['id','name']) );
        Inertia::share('statuses', Status::all(['id','name']) );
        Inertia::share('taskProp', Task::with('user','category','project','status')->get() );
        return Inertia::render('Dashboard');
    }
    public function filter(Request $request)
    {
        $task = Task::select();

        if(isset($request->project)){
            $task->where('project_id','=', $request->project);
        }

        if(isset($request->filters['status'])){
            $task->where('status_id','=', $request->filters['status']);
        }

        if(isset($request->filters['category'])){
            $task->where('category_id','=', $request->filters['category']);
        }

        return $task->with('user','category','project','status')->get() ;
    }

    public function project(Request $request)
    {
        $project = project::where('id','=', $request->project)->first();
        $done = Task::where('project_id','=', $request->project)->where('status_id','=', 1)->count();
        $total = Task::where('project_id','=', $request->project)->where('status_id','!=', 1)->count();
        return  (object)[
            'project' => [
                'name'  => $project->name,
                'started'  => $project->created_at,
                'compelte'  => number_format( ($done/$total)*100,2),
            ],
            'tasks' => Task::where('project_id','=', $request->project)->with('user','category','project','status')->get(),
        ];
    }


    public function search(Request $request)
    {
        $task = Task::select();
        if(isset($request->project)){
            $task->where('project_id','=', $request->project);
        }
        return $task->where('name', 'LIKE', "%$request->term%")->orWhere('description', 'LIKE', "%$request->term%")->with('user','category','project','status')->get() ;
    }
}
