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
        <h1>睡眠時間</h1>
        <form action="{{route('home.store')}}" method="POST">
            @csrf
            <div class="sleeptime">
                <h2>入眠時間</h2>
                <input type="time" name="time">
                <input type="submit" value="登録"/>
        </form>
        
        <p>{{$aa}}</p>
        <div class="top"><a href='/'>TOPへ</a></div>
    </body>
</html>