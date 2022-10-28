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
        <h1>問題一覧</h1>
        <a href='{{route('question.create')}}'>新規作成</a>
        @foreach ($question as $quest)
        <fieldset>
            <legend><h1>{{ $quest->question }}</h1></legend>
            </div>
            <h2>{{$quest->correct}}</h2>
            <a href='{{route('question.edit', ['question' => $quest->id])}}'>編集</a>
        </fieldset>
        @endforeach
        <a href='{{route('home.index')}}'>TOPへ</a>
    </body>
</html>
