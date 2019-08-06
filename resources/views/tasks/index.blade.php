@extends('layouts.app')

@section('title', 'Task-Neung')

@section('content')

<!-- {{ $title }} -->

<table class="table">
<h1 class="text-center">Tasks</h1>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Type</th>
      <th scope="col">Task Name</th>
      <th scope="col">Detail</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
      <th scope="col">Manage</th>
    </tr>
  </thead>
  <tbody>
    @foreach($tasks as $task)
    <tr>
      <th scope="row">{{$task->id}}</th>
      <td>{{$task->type}}</td>
      <td>{{$task->name}}</td>
      <td>{{$task->detail}}</td>
      <td>{{$task->status? 'Completed':'Incomplete'}}</td>
      <td>
        <form id="check-complate-{{ $task->id }}" action="/tasks/{{ $task->id }}" method="POST" style="display: none;">
              @csrf
              @method('patch')
             <input type="hidden" name="status" value="1">
        </form>
        @if(!$task->status)
        <button class="btn btn-sm btn-info" onclick="document.getElementById('check-complete-{{ $task->id }}'.submit()">Completed</button>
        @endif
      </td>
      <td>
        <button class="btn btn-sm btn-info" href="{{ url('tasks', $task->id) }}">Edit</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
