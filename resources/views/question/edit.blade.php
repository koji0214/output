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
        <h1>問題編集</h1>
        <form action="{{route('question.update', ['question' => $question->id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="questions">
                <h2>問題</h2>
                <input type="text" name="question[question]" placeholder="問題" value="{{$question->question}}"/>
                
                <h2>正解</h2>
                <textarea name="question[correct]" placeholder="正解">{{$question->correct}}</textarea>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back"><a href='{{route('question.index')}}'>戻る</a></div>
    </body>
</html>