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
        @if(!$task->status)
        <button class="btn btn-sm btn-info">Completed</button>
        @endif
      </td>
      <td>
        <button class="btn btn-sm btn-info" href="{{ url('tasks', $task->id) }}">Edit</button>
      </td>
    </tr>
    @endforeach
    <tr>
      <th scope="row">2</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>

@endsection
