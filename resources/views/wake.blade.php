@extends('layouts.app')

@section('content')

    <canvas id="myChart" width="400" height="100"></canvas>
    <p>wake up!</p>
@endsection

@section('js')

<script>
window.onload = function() {
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
}// ctx　描画対象のエレメント
</script>
@endsection
