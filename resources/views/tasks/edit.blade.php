@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

<div class="flex justify-center mt-5">
    <div class="w-full max-w-md">
        <div class="flex justify-between mb-2">
            <div></div>
            <h1 class="text-center text-xl">Edit Task</h1>
            <div></div>
        </div>

        <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="task_name">
                    Task Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="task_name" type="text" name="task_name" value="{{ $task->task_name }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">
                    Priority
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="priority" type="number" name="priority" value="{{ $task->priority }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="project_id">
                    Project
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="project_id" name="project_id">
                    @foreach($projects as $project)
                        @if($project->id == $task->project_id)
                            <option value="{{ $project->id }}" selected>{{ $project->name }}</option>
                        @else
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
