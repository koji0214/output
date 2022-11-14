<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sleep;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Level;
use App\TaskCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(TaskCategory $category)
    {
        // levelの取得
        $level = Level::find(Auth::id());
        
        // タスクの取得（ユーザーのタスクのうち、未完了のものを期日順に5件表示）
        $task = Task::find(Auth::id())->where('status', false)->orderBy('limit')->limit(5)->get();
        
        // 睡眠時間のグラフ可視化のためのデータ取得
        $sleeps = Sleep::where('user_id','=',Auth::id())->orderBy('id', 'DESC')->take(14)->get();
        $times = [];
        
        // 余裕があったら、reverseを修正する
        foreach($sleeps as $sleep){
            $time = -(strtotime($sleep->sleep_time,strtotime($sleep->created_at))-strtotime($sleep->created_at))/3600;
            array_push($times,$time);
        }
        if(count($times)<7){
            $ratio = [];
            for($i=0;$i<7;$i++){
                array_push($ratio, 0);
            }
            $time = array_reverse($times);
            $times = [];
            for($i=0;$i<(7-count($time));$i++){
                array_push($times,0);
            }
            $times = array_merge($times, $time);
        }elseif(count($times)<14){
            $ratio = [];
            for($i=0;$i<(14-count($times));$i++){
                array_push($ratio, 0);
            }
            $time2 = array_slice($times,0,count($times)-7);
            $time2 = array_reverse($time2);
            $time = array_slice($times,-7);
            $time = array_reverse($time);
            
            for($i=0;$i<count($time2);$i++){
                array_push($ratio, $time2[$i]/$time[$i]*100);
            }
            $times = $time;
        } else{
            $ratio = [];
            for($i=0;$i<7;$i++){
                array_push($ratio, $times[$i]/$times[$i+7]*100);
            }
            $times = array_slice($times , 0, 7);    
        }
        //////ここまで
        // dd($category->get());
        // dd($task[0]);
        
        return view('home')->with(['tasks' => $task,
            'sleeps' => $sleeps,
            'time' => $times,
            'ratio' => $ratio,
            'level' => $level,
            'categories'=> $category->get(),
        ]);
    }
    public function create(Request $request){
        $input = $request['num_of_inq%'];
        return view('create')->with([
            'aa' => $input,
        ]);
    }
    public function store(Request $request){
        $sleep = new Sleep;
        $sleep->user_id = Auth::id();
        $sleep->date = date(now());
        $sleep->sleep_time = $request->input('time');
        $sleep->save();
        $level = Level::find(Auth::id());
        $level->level +=100;
        $level->save();
        
        return redirect(route('home.index'));
    }
    public function edit($id){
        
    }
    public function update($id){
        
    }
}
