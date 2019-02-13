<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });


    Route::get('/task/update/{id}/', function ($id) {

            // // Task::findOrFail($id)->update(['name' => $name]);
            // $task = Task::where('id', auth()->user()->id)
            // ->where('id', $id)
            // ->first();

        return view('tasksupdate',  [
            'task' => Task::findOrFail($id)
        ]);
    });

    Route::post('/task/{id}/save', function ($id,Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/task/'.$id)
                ->withInput()
                ->withErrors($validator);
        }

        $task = Task::findOrFail($id);
        $task->name=$request->name;
        $task->save();
        
         return redirect('/');
    });




    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });
});
