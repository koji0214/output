@extends('layouts.app')

@section('content')
<div class="container">
    <h1>問題投稿</h1>
    <form action="{{route('question.store')}}" method="POST">
        @csrf
        <div class="questions">
            <div class="row g-3">
                <div class="col-12">
                <input type="text" class="form-control" name="question[question]" placeholder="問題"/>
            </div>
            <div class="col-12">
                <textarea class="form-control" name="question[correct]" placeholder="正解"></textarea>
            </div>
        </div>
        <input class="btn btn-outline-secondary mt-2" type="submit" value="保存"/>
    </form>
    <div class="back"><a href='{{route('question.index')}}'>戻る</a></div>
</div>
    
@endsection