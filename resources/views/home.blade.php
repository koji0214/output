@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Page</h1>
    <div>現在のレベル：{{ $level->level }}</div>
    <div class="row">
        <div class="col">
            <a href='{{route('wake.index')}}'>起床登録</a>
        </div>
        <div class="col">
            <a href='{{route('home.create')}}'>睡眠ログ</a>
        </div>
        <div class="col">
            <a href='{{route('question.index')}}'>問題確認</a>
        </div>
        <div class="col">
            <a href='{{route('task.index')}}'>タスク</a>
        </div>
    </div>
</div>



<div class="container">
    <h1>ToDo投稿</h1>
    <div class="input-group">
        <form action="{{route('task.store')}}" method="POST">
            @csrf
            
                <div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="task[task]" placeholder="何をする？" value="{{ old('task.task') }}"/>
                            @error('task.task')
                                <div class='mt-3'>
                                    <p class="text-red-500">{{$message}}</p>
                                </div>
                            @enderror
                        </div>
                            
                    
                        <div class="col">
                            <input type="datetime-local" name="task[limit]" value="{{ old('task.limit') }}">
                            @error('task.limit')
                                <div class='mt-3'>
                                    <p class="text-red-500">{{$message}}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <textarea name="task[memo]" placeholder="メモ" value="{{ old('task.memo') }}"></textarea>
                    </div>
                
                    <button type="submit" class="btn btn-outline-secondary">保存</button>
                </div>
        </form>
    </div>
</div>
    
<div class="container">
    <h1>タスク一覧</h1>
    <div class="container">
        
        @if($tasks->isEmpty())
        <p>現在のタスクはありません</p>
        @else
        
        <div class="row">
            @foreach ($tasks as $item)
                <div class="col-7">
                    <div>
                        {{ $item->task }}
                    </div>
                    <div>
                        {{date('Y年n月j日 g:i', strtotime($item->limit))}}
                    </div>
                    <div>
                        {{ $item->memo }}
                    </div>
                </div>
                
                <div class="col-5">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('task.update', $item->id) }}"
                                method="post"
                                class="inline-block text-gray-500 font-medium"
                                role="menuitem" tabindex="-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{$item->status}}">
                                <button type="submit"
                                 class="bg-emerald-700 py-4 w-20 text-white md:hover:bg-emerald-800 transition-colors">完了</button>
                            </form>
                        </div>
                        <div class="col">
                            <a href="{{ route('task.edit', $item->id) }}"
                            class="inline-block text-center py-4 w-20 underline underline-offset-2 text-sky-600 md:hover:bg-sky-100 transition-colors">編集</a>
                        </div>        
                        <div class="col">
                            <form onsubmit="return deleteTask()"
                                action="{{ route('task.destroy', $item->id) }}" method="post"
                                class="inline-block text-gray-500 font-medium"
                                role="menuitem" tabindex="-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                class="py-4 w-20 md:hover:bg-slate-200 transition-colors">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
            
        @endif
    </div>
        
</div>    
        
          

<canvas id="myChart" width="400" height="100"></canvas>
<script>
    function deleteTask() {
        if (confirm('本当に削除しますか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>

@endsection

@section('js')

<script>
window.onload = function() {
    // ctx　描画対象のエレメント
    const ctx = document.getElementById("myChart").getContext("2d");

    // グラフの定義と描画
    const myChart = new Chart(ctx, {
        // ctx：描画先
        type: "line",
        data: {
            labels: ["日", "月", "火","水","木","金","土"],
        datasets: [
            {
                label: "睡眠時間(今週）",
            
                data: [
                    @foreach($time as $t)
                        {{$t}},
                    @endforeach
                ],

                fill: true,
                borderColor: "rgb(75, 192, 192)",
                tension: 0.1,
                borderWidth: 5,
                yAxisID: "y1",
            },

          
            {
                label: "起床時間(先週比)",
                data: [
                    @foreach($ratio as $t)
                        {{$t}},
                    @endforeach
                ], // Laravel変数に変更
    
                fill: true,
                borderColor: "red",
                tension: 0.1,
                borderWidth: 5,
                yAxisID: "y2",
            },
        ],
      },
      options: {
      scales: {
        y1: {
            type:         "linear",
            position:     "left",
            display:      true,
            max: {{1.2*max($time)}},
            min: {{0.8*min($time)}},
            ticks: {
              stepSize: 0.5,
            },
        },
        y2: {
            type:         "linear",
            position:     "right",
            display:      true,
            max: {{1.2*max($ratio)}},
            min: 0,
            ticks: {
              stepSize: 0.5,
            },
        }
      },
    },
      
    },
    
    );
}
</script>
@endsection
