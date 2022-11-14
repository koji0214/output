@extends('layouts.app')
@section('content')
<div class="container">
    <h1>睡眠時間</h1>
    <form action="{{route('home.store')}}" method="POST">
        @csrf
        <h2>入眠時間を入力してください</h2>
        <div class="input-group mb-3">
            <input class="form-control" type="time" name="time">
            <button class="btn btn-outline-secondary" type="submit">登録</button>
        </div>
    </form>
    
        
    <div class="top"><a href='/'>TOPへ</a></div>


@endsection