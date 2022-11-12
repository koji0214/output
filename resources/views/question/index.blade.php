@extends('layouts.app')

@section('content')
<div class="container">
    <h1>問題一覧</h1>
    <a href='{{route('question.create')}}'>新規作成</a>
    <div class="row">
        <div class="col">
            <h2>問題</h2>
        </div>
        <div class="col">
            <h2>正解</h2>
        </div>
    </div>
                
            
    @foreach ($question as $quest)
        <div class="row">
            <div class="col">
                <h1><a href='{{route('question.edit', ['question' => $quest->id])}}'>{{ $quest->question }}</a></h1>
            </div>
            <div class="col">
                <h2>{{$quest->correct}}</h2>
            </div>
        </div>
    @endforeach
        
    <a href='{{route('home.index')}}'>TOPへ</a>
</div>
@endsection
