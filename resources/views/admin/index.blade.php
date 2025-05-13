@extends('layouts.app')

@section('header')
    <h1>Statistika porudžbina</h1>
@endsection

@section('content')

<div id="curve_chart" style="width: 100%; max-width: 900px; height: 500px; margin: auto;"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Datum', 'Broj porudžbina'],
      @foreach($ordersPerDate as $order)
        ['{{ \Carbon\Carbon::parse($order->date)->format("d.m.Y") }}', {{ $order->total_orders }}],
      @endforeach
    ]);

    var options = {
      title: 'Broj porudžbina po datumu',
      curveType: 'function',
      legend: { position: 'bottom' },
      hAxis: { title: 'Datum' },
      vAxis: { title: 'Porudžbine' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    chart.draw(data, options);
  }
</script>

@endsection
