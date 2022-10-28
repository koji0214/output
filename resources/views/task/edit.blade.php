<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>目覚ましソフト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1>ToDo編集</h1>
        <form action="{{route('task.update', $task->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="task">
                <h2>タイトル</h2>
                <input type="text" name="task[task]" placeholder="タイトル"　value="{{ old('task.task', $task->task) }}"/>
                @error('task.task')
                    <div class='mt-3'>
                        <p class="text-red-500">{{$message}}</p>
                    </div>
                @enderror
                <h2>締切</h2>
                <input type="datetime-local" name="task[limit]" value="{{ old('task.limit', $task->limit) }}">
                @error('task.limit')
                    <div class='mt-3'>
                        <p class="text-red-500">{{$message}}</p>
                    </div>
                @enderror
                <h2>メモ</h2>
                <textarea type="datetime-local" name="task[memo]" value="{{ old('task.memo', $task->memo) }}"></textarea>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back"><a href='{{route('task.index')}}'>戻る</a></div>
        <div class="top"><a href='{{route('home.index')}}'>TOPへ</a></div>
    </body>
</html>