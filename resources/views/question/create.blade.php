@extends('layouts.app')

@section('content')
        <h1>問題投稿</h1>
        <form action="{{route('question.store')}}" method="POST">
            @csrf
            <div class="questions">
                <h2>問題</h2>
                <input type="text" name="question[question]" placeholder="問題"/>
                
                <h2>正解</h2>
                <textarea name="question[correct]" placeholder="正解"></textarea>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back"><a href='{{route('question.index')}}'>戻る</a></div>
@endsection