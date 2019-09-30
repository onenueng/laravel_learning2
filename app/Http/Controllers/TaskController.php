<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use \App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types[] = ['id' => 1, 'name' => 'Support'];
        $types[] = ['id' => 2, 'name' => 'Maintain'];
        $types[] = ['id' => 3, 'name' => 'Change Requirement']; 
    
        $statuses[] = ['id' => 0, 'name' => 'Incompleate'];
        $statuses[] = ['id' => 1, 'name' => 'compleate'];
        $tasks = Task::all();
    
        $title = "create Form";
        $data = request()->all();
        if (request()->has ('status')){
            $data['status'] = true;
        }
        return view('tasks.index')
                ->with([
                    'tasks'=>\App\Task::all(),
                    'title'=>$title,
                    'types'=>$types,
                    'statuses'=>$statuses
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $types[] = ['id' => 1, 'name' => 'Support'];
            $types[] = ['id' => 2, 'name' => 'Maintain'];
            $types[] = ['id' => 3, 'name' => 'Change Requirement']; 

            $statuses[] = ['id' => 0, 'name' => 'Incompleate'];
            $statuses[] = ['id' => 1, 'name' => 'compleate'];
            return view('tasks.create')->with([ 'types' => $types, 'statuses' => $statuses ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $validation = $request->validate([
            'type'=> 'required',
            'name'=> 'required|max:255',
            'detail'=> 'required'
        ]);
    
        $task = Task::create($request->all()); //function create เพื่อรับค่าเข้าตาราง แต่เราต้องไปบันทึก fillable ที่ file task.php
        if ($request->hasFile('file_upload')){
            $path = $request->file('file_upload')->store('/public');
            //$path = $request->file('file_upload')->storeAs('/',$request->file('file_upload')->getClientOriginalName());
            $filename = pathinfo($path);
            $task->file_upload = $filename['basename'];
            $task->update();
            //return Storage::downlaod($path);
            return Storage::url($path);
        }else{
            return 'no file';
        }
        return redirect()->back()->with('success','Created Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types[] = ['id' => 1, 'name' => 'Support'];
        $types[] = ['id' => 2, 'name' => 'Maintain'];
        $types[] = ['id' => 3, 'name' => 'Change Requirement']; 
    
        $statuses[] = ['id' => 0, 'name' => 'Incompleate'];
        $statuses[] = ['id' => 1, 'name' => 'compleate'];
    
        $task = Task::find($id);
    
        $tasks = Task::all();
            if(empty($task)){
                return "Not found";
            }
        
    
        //return view('tasks.edit')->with(['types'=>$types,'statuses'=>$statuses,'task'=> $task]);
        return view('tasks.index')
               ->with([
                        'types'=>$types,
                        'statuses'=>$statuses,
                        'task'=> $task,
                        'tasks'=>$tasks,
                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'type'=> 'required',
            'name'=> 'required|max:255',
            'detail'=> 'required'
        ]);
        
        Task::find($id)->update($request->all()); //ทำการ update
        //return $request->all();
        return redirect()->back()->with('success','Edited Successfully !!');
    }

    public function updateStatus(Task $task){
        $task->update(request()->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
