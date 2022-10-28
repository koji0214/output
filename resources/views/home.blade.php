@extends('layouts.app')

@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>目覚ましソフト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>

        <h1>My Page</h1>
        <a href='{{ route('wake.index')}}'>起床登録</a><br>
        
        <a href='{{ route('home.create')}}'>睡眠ログ</a><br>
        
        <a href='{{ route('question.index')}}'>問題確認</a><br>
        
        <a href='{{route('task.index')}}'>タスク</a><br>
        
        <canvas id="myChart" width="400" height="100"></canvas>
        
        
        <div id="app">
            <example-component></example-component>
        </div>
        <script src="{{mix('js/app.js')}}"></script>
        
    </body>
    <script>
        // ctx　描画対象のエレメント
        const ctx = document.getElementById("myChart").getContext("2d");
    
        // グラフの定義と描画
        const myChart = new Chart(ctx, {
          // ctx：描画先
          type: "line",
          data: {
            labels: ["日", "月", "火", "水", "木", "金", "土"],
            datasets: [
              {
                label: "睡眠時間",
                data: [3, 8, 4, 6, 6, 4, 1], // Laravel変数に変更
    
                fill: true,
                borderColor: "rgb(75, 192, 192)",
                tension: 0.1,
                borderWidth: 5,
              },
    
              
              {
                label: "起床時間",
                data: [1, 2, 8, 12, 3, 1, 4], // Laravel変数に変更
    
                fill: true,
                borderColor: "red",
                tension: 0.1,
                borderWidth: 5,
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      </script>
</html>

@endsection
