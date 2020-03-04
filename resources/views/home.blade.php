@extends('layouts.app')
@section('title') Tablero @endsection
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Tablero</h1>
      <p>Sistema de Inventario | Licancabur</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ url('home') }}">Tablero</a></li>
    </ul>
  </div>
  <div class="row">
    {{-- <div class="col-md-6 col-lg-4">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Usuarios</h4>
          <p><b>5</b></p>
        </div>
      </div>
    </div> --}}
    <div class="col-md-6 col-lg-4">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-sitemap fa-3x"></i>
        <div class="info">
          <h4>Insumos</h4>
          <p><b>{{ $i }}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="widget-small warning coloured-icon"><i class="icon fa  fa-handshake-o fa-3x"></i>
        <div class="info">
          <h4>Préstamos</h4>
          <p><b>{{ $p }}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
        <div class="info">
          <h4>Incidencias</h4>
          <p><b>{{ $in }}</b></p>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
