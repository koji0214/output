<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Task;
use App\TaskCategory;
use App\Level;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskCategory $category)
    {
        //
        // dd($category);
        $task = Task::find(Auth::id())->where('status', false)->orderBy('limit')->get();
        return view('task.index')->with([
            'tasks' => $task,
            'categories' => $category->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TaskCategory $category)
    {
        //
        return view('task.create')->with(['categories'=>$category->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'task.task' => 'required', 'task.limit' =>'required',
        ];
         
        $messages = ['required' => '必須項目です'];
        Validator::make($request->all(), $rules, $messages)->validate();
        
        $task = new Task;
        $task->user_id = Auth::id();
        $task->task = $request->input('task.task');
        $task->limit = $request->input('task.limit');
        $task->memo = $request->input('task.memo');
        $task->task_category_id = $request->input('task.category');
        $task->save();
        return redirect('/');
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
        //
        $task = Task::find($id);
        return view('task.edit')->with(['task'=>$task]);
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
        //
        if ($request->status === null) {
            $rules = [
                'task.task' => 'required', 'task.limit' =>'required',
            ];
             
            $messages = ['required' => '必須項目です'];
            Validator::make($request->all(), $rules, $messages)->validate();
            
            $task = Task::find($id);
            $task->user_id = Auth::id();
            $task->task = $request->input('task.task');
            $task->limit = $request->input('task.limit');
            $task->memo = $request->input('task.memo');
        } else{
            $task = Task::find($id);
            //モデル->カラム名 = 値 で、データを割り当てる
            $task->status = true; //true:完了、false:未完了
            $level = Level::find(Auth::id());
            $level->level += 30;
            $level->save();
        }
        $task->save();
        return redirect('/');
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
        Task::find($id)->delete();
        return redirect(route('/'));
    }
}
