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

Route::get('/tasks/create','TaskController@create');



Route::get('/index', 'TaskController@index');




Route::post('/tasks/store', 'TaskController@store');

Route::get('/tasks/{id}','TaskController@edit');

Route::PUT('/tasks/{id}','TaskController@update');

Route::patch('/tasks/{task}', 'TaskController@updateStatus');//เป็น route ของเวลาที่กดปุ่ม complete แล้วจะ update ค่า status จะเปลี่ยนไปและปุ่มจะหายไป
    


Route::get('/upload',function(){
    return view('upload-file');
});
Route::post('/upload', function() {
    if(request()->hasFile('file_upload')) {
        $path = request()->file('file_upload')->store('/');

        $time_stamps = new \App\Imports\TimeStampsImport();
        $time_stamps->import(storage_path('app/' . $path));
    }else{
        return 'no file';
    }
    return redirect()->back()->with('message', 'IT WORKS!');
});