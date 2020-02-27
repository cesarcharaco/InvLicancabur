@extends('layouts.app')
@section('title') Registro de incidencia @endsection
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Inventario</h1>
      <p>Sistema de Inventario | Licancabur</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="">Inventario</a></li>
      <li class="breadcrumb-item"><a href="{{ url('inventario/incidencias') }}">Incidencias</a></li>
      <li class="breadcrumb-item"><a href="">Registro de incidencia</a></li>
    </ul>
  </div>
  <div class="tile mb-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h2 class="mb-3 line-head" id="indicators">Incidencias</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h4>Registro de incidencias <small>Todos los campos (<b style="color: red;">*</b>) son requeridos.</small></h4>
          <div class="tile-body">
            <form>
              <div class="row">
                <div class="col-md-4 mt-3">                  
                  <div class="form-group">
                    <label class="control-label">Equipo <b style="color: red;">*</b></label>
                    <select name="empleado" id="" class="form-control">
                      <option value="">Compresor | Serial: SDFA1246</option>
                      <option value="">Computador | Serial: SDFA1247</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 mt-3">                  
                  <div class="form-group">
                    <label class="control-label">Observación <b style="color: red;">*</b></label>
                    <input type="text" class="form-control" placeholder="Ingrese observación">
                  </div>
                </div> 
                <div class="col-md-4 mt-3">                  
                  <div class="form-group">
                    <label class="control-label">Cantidad <b style="color: red;">*</b> <small>(cantidad que presenta la incidencia)</small></label>
                    <input class="form-control" type="text" placeholder="Ingrese cantidad">
                  </div>
                </div>
              </div><hr>
              <div class="row">
                <div class="col-md-12 text-right">
                  <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-plus"></i>Agregar otro equipo</button>
                </div>
              </div>
            </form>
          </div>
          <div class="tile-footer">
            <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{ url('inventario/incidencias') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Volver</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
