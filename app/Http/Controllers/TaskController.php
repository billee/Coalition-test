<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index(string $project_id = null)
    {

        if(!$project_id){
            $projects = Project::where('user_id', Auth::user()->id)->get();
            $project_id = $projects->first()->id;
        }else{
            $projects = Project::where('user_id', Auth::user()->id)
                    ->where('id', $project_id)->get();
        }

        $tasks = Task::where('user_id', Auth::user()->id)
                    ->where('project_id',$project_id)
                    ->orderBy('priority', 'asc')
                    ->get();



        return view('tasks.index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a task.
     */
    public function create()
    {
        $projects = Project::where('user_id', Auth::user()->id)->get();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created task.
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        Task::create([
            'task_name' => $validated['task_name'],
            //'priority' => 0,
            'project_id' => $validated['project_id'],
            'user_id'    => Auth::user()->id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the edit form.
     */
    public function edit(string $id)
    {
        $task = Task::where('user_id', Auth::user()->id)
                    ->where('id',$id)
                    ->first();

        $projects = Project::where('user_id', Auth::user()->id)->get();

        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update a task.
     */
    public function update(StoreTaskRequest $request, int $id)
    {
        $validated = $request->validated();

        $task = Task::where('id', $id)->first();

        $task->update([
            'task_name' => $validated['task_name'],
            'priority' => $validated['priority'],
            'project_id' => $validated['project_id'],
            'user_id'    => Auth::user()->id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * delete a task.
     */
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->first()->delete();

        return redirect()->route('tasks.index')->with('success', 'Task was deletedd successfully.');
    }

    /**
     * drag and drop rows
     */
    public function reorder(Request $request)
    {
        foreach ($request->input('order') as $order) {
            dump($order);
            Task::where('id', $order['id'])->update(['priority' => $order['position']]);
        }

        return response('Success', 200);
    }
}
