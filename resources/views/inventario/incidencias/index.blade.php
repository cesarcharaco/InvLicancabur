@extends('layouts.app')
@section('title') Incidencias @endsection
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
      <li class="breadcrumb-item"><a href="">Incidencias</a></li>
    </ul>
  </div>
  <div class="tile mb-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h2 class="mb-3 line-head" id="indicators">Incidencias
            <a class="btn btn-primary icon-btn pull-right" href="{{ url('inventario/incidencias/create') }}"><i class="fa fa-plus"></i>Registrar incidencia</a>
          </h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Equipo</th>
                  <th>Serial</th>
                  <th>Tipo</th>
                  <th>Observación</th>
                  <th>Cantidad</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Casco</td>
                  <td>SDFA1245</td>
                  <td>FDK</td>
                  <td>Dañado</td>
                  <td>10</td>
                  <td>
                    <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar incidencia"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_incidencia"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Esmeril</td>
                  <td>SDFA1246</td>
                  <td>LTE</td>
                  <td>Falla de motor</td>
                  <td>25</td>
                  <td>
                    <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar incidencia"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_incidencia"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Impresora</td>
                  <td>SDFA1247</td>
                  <td>LTE</td>
                  <td>Sin toner</td>
                  <td>17</td>
                  <td>
                    <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar incidencia"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_incidencia"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Laptop</td>
                  <td>SDFA1248</td>
                  <td>FDK</td>
                  <td>Dañado S.O.</td>
                  <td>11</td>
                  <td>
                    <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar incidencia"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_incidencia"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<div class="bs-component">
  <div class="modal" id="eliminar_incidencia">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fa fa-trash"></i> Eliminar incidencia</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <p>¿Estas seguro que desea eliminar esta incidencia?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="submit">Eliminar</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
          </div>          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
