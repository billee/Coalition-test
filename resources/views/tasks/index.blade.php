@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <div class="flex justify-center mt-5">
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        <div class="w-full max-w-md">
            <div class="flex justify-between mb-2">
                <a href="{{ route('tasks.create') }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                        <i class="fas fa-plus"></i>
                    </button>
                </a>
                {{-- <h1 class="text-center text-xl">{{$tasks->first()->project_name}}</h1> --}}
                <div>
                    <select class="rounded border-gray-300 text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                        <option value="">Select project name...</option>
                        @foreach($projects as $key=>$project)
                            @if($key == 0)
                                <option value="{{$key}}" selected>{{$project->name}}</option>
                            @else
                                <option value="{{$key}}">{{$project->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-blue-200">
                        {{-- <th class="px-4 py-2">Priority</th> --}}
                        <th class="px-4 py-2">Task Name</th>
                        <th class="px-4 py-2"></th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr data-id="{{ $task->id }}" class="{{ $loop->iteration % 2 ? 'bg-blue-100' : 'bg-white' }}">
                            {{-- <td class="border px-4 py-2">{{ $task->priority }}</td> --}}
                            <td class="border px-4 py-2">{{ $task->task_name }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('tasks.edit', $task->id) }}">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="border px-4 py-2">
                                <form method="POST" action="{{ route('tasks.delete', $task->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
