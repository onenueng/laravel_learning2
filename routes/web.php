<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/username', function () {
//     return 'OneNueng';
// });

// Route::get('/username/{name}', function ($name) {
//     return 'username ' . $name;
// });

Route::get('/index', function(){
    $title = "create Form";

    return view('index')->with(['title'=>$title]);
});



// Route::post('/store', function(Illuminate\Http\Request $request){
//     return $request->all();
//     return "Login Success";
// });

Route::get('/tasks/create',function(){
    $types[] = ['id' => 1, 'name' => 'Support'];
    $types[] = ['id' => 2, 'name' => 'Maintain'];
    $types[] = ['id' => 3, 'name' => 'Change Requirement']; 

    $statuses[] = ['id' => 0, 'name' => 'Incompleate'];
    $statuses[] = ['id' => 1, 'name' => 'compleate'];
    return view('tasks.create')->with([ 'types' => $types, 'statuses' => $statuses ]);
});



// Route::get('/index', function () {
   
//     return view('index');
// });

Route::post('/tasks/store', function(Illuminate\Http\Request $request){
    // $task = new \App\Task();
    // $task->type = $request->type;
    // $task->name = $request->name;
    // $task->detail = $request->detail;
    // $task->status = $request->status;
    // $task->save();

    App\Task::create($request->all()); //function create เพื่อรับค่าเข้าตาราง แต่เราต้องไปบันทึก fillable ที่ file task.php
    return redirect()->back()->with('success','Created Successfully !!');
});
