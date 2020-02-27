@extends('layouts.app')
@section('title') Gráficas @endsection
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pie-chart"></i> Gráficas</h1>
      <p>Sistema de Inventario | Licancabur</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ url('graficas') }}">Gráficas</a></li>
    </ul>
  </div>
  <div class="tile mb-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h2 class="mb-3 line-head" id="indicators">Gráficas</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Status de equipos</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="doughnutChartDemo"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Status de incidencias</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Status de equipos | Carlos Vega RUT: 87654321</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/plugins/chart.js') }}"></script>
<script type="text/javascript">
  var data = {
    labels: ["En uso", "Entregado", "Entregado con observaciones", "Solicitado"],
    datasets: [
      {
        label: "My Second dataset",
        fillColor: "rgba(151,187,205,0.2)",
        strokeColor: "rgba(151,187,205,1)",
        pointColor: "rgba(151,187,205,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(151,187,205,1)",
        data: [28, 48, 40, 19]
      }
    ]
  };
  var pdata = [
    {
      value: 15,
      color:"#F6BB42",
      highlight: "#F7C55F",
      label: "En uso"
    },
    {
      value: 50,
      color: "#37BC9B",
      highlight: "#48C9A9",
      label: "Entregado"
    },
    {
      value: 100,
      color: "#DA4453",
      highlight: "#DF5E6A",
      label: "Entregado con observaciones"
    },
    {
      value: 100,
      color: "#3BAFDA",
      highlight: "#55B9DF",
      label: "Solicitado"
    }
  ]

  var pdata1 = [
    {
      value: 100,
      color:"#F6BB42",
      highlight: "#F7C55F",
      label: "Reparado"
    },
    {
      value: 100,
      color: "#DA4453",
      highlight: "#DF5E6A",
      label: "Dañado"
    },
    {
      value: 100,
      color: "#3BAFDA",
      highlight: "#55B9DF",
      label: "No entregado"
    }
  ]
  
  
  var ctxb = $("#barChartDemo").get(0).getContext("2d");
  var barChart = new Chart(ctxb).Bar(data);

  var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");
  var doughnutChart = new Chart(ctxd).Doughnut(pdata);

  var ctxp = $("#pieChartDemo").get(0).getContext("2d");
  var pieChart = new Chart(ctxp).Pie(pdata1);
</script>
<!-- Google analytics script-->
<script type="text/javascript">
  if(document.location.hostname == 'pratikborsadiya.in') {
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-72504830-1', 'auto');
    ga('send', 'pageview');
  }
</script>
@endsection