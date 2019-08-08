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



Route::get('/index', function () {
    $title = "create Form";
    $data = request()->all();
    if (request()->has ('status')){
        $data['status'] = true;
    }
    return view('tasks.index')->with(['tasks'=>\App\Task::all(),'title'=>$title]);
});

Route::patch('/tasks/{id}', function ($id) {//เป็น route ของเวลาที่กดปุ่ม complete แล้วจะ update ค่า status จะเปลี่ยนไปและปุ่มจะหายไป
    $task = App\Task::find($id);
    $task->update(request()->all());
    return back();
});


Route::post('/tasks/store', function(Illuminate\Http\Request $request){
    // $task = new \App\Task();
    // $task->type = $request->type;
    // $task->name = $request->name;
    // $task->detail = $request->detail;
    // $task->status = $request->status;
    // $task->save();
    $validation = $request->validate([
        'type'=> 'required',
        'name'=> 'required|max:255',
        'detail'=> 'required'
    ]);

    App\Task::create($request->all()); //function create เพื่อรับค่าเข้าตาราง แต่เราต้องไปบันทึก fillable ที่ file task.php
    return redirect()->back()->with('success','Created Successfully !!');
});

Route::get('/tasks/{id}',function($id){
    $types[] = ['id' => 1, 'name' => 'Support'];
    $types[] = ['id' => 2, 'name' => 'Maintain'];
    $types[] = ['id' => 3, 'name' => 'Change Requirement']; 

    $statuses[] = ['id' => 0, 'name' => 'Incompleate'];
    $statuses[] = ['id' => 1, 'name' => 'compleate'];

    $task = App\Task::find($id);

    return view('tasks.edit')->with(['types'=>$types,'statuses'=>$statuses,'task'=> $task]);
});

Route::PUT('/tasks/{id}',function(Illuminate\Http\Request $request,$id){
    $validation = $request->validate([
        'type'=> 'required',
        'name'=> 'required|max:255',
        'detail'=> 'required'
    ]);
    
    App\Task::find($id)->update($request->all()); //ทำการ update
    //return $request->all();
    return redirect()->back()->with('success','Edited Successfully !!');
});



