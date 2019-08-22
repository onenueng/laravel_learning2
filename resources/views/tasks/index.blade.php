@extends('layouts.app')

@section('title', 'Task-Neung')

@section('content')



<table class="table">
<h1 class="text-center">Tasks</h1>
  @include('tasks._form')
  
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
      <td>{{$task->getTypeName()}}</td> <!--เปลี่ยนจาก$task->type เป็น gettypenameตามtask.php-->
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
        <button 
          class="btn btn-sm btn-info" 
          onclick="document.getElementById('check-complate-{{ $task->id }}').submit()">Completed
        </button>
        @endif
      </td>
      <td>
      
        <a class="btn btn-sm btn-success" role="button" href="{{ url('/tasks', $task->id) }}">Edit</a>
        <form id="delete-task-{{ $task->id }}" action="/tasks/{{ $task->id }}" method="POST" style="display: none;">
              @csrf
              @method('delete')
        </form>
        @if(!$task->status)
          <button 
            class ="btn btn-sm btn-danger"
            onclickk="document.getElementById('delete-task-{{ $task->id }}').submit()"
          >Delete</button>
        @endif 
      </td> 
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
