@extends('layouts.app')

@section('content')
        <h1>ToDo投稿</h1>
        <form action="{{route('task.store')}}" method="POST">
            @csrf
            <div class="task">
                <h2>タイトル</h2>
                <input type="text" name="task[task]" placeholder="タイトル"　value="{{ old('task.task') }}"/>
                @error('task.task')
                    <div class='mt-3'>
                        <p class="text-red-500">{{$message}}</p>
                    </div>
                @enderror
                <h2>締切</h2>
                <input type="datetime-local" name="task[limit]" value="{{ old('task.limit') }}">
                @error('task.limit')
                    <div class='mt-3'>
                        <p class="text-red-500">{{$message}}</p>
                    </div>
                @enderror
                <h2>メモ</h2>
                <textarea type="datetime-local" name="task[memo]" value="{{ old('task.memo') }}"></textarea>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back"><a href='{{route('task.index')}}'>戻る</a></div>
        <div class="top"><a href='{{route('home.index')}}'>TOPへ</a></div>
@endsection
