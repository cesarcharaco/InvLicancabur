@extends('layouts.app')
@section('title') Préstamos @endsection
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
      <li class="breadcrumb-item"><a href="">Préstamos</a></li>
    </ul>
  </div>
  <div class="tile mb-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h2 class="mb-3 line-head" id="indicators">Préstamos
            <a class="btn btn-primary icon-btn pull-right" href="{{ route('prestamos.create') }}"><i class="fa fa-plus"></i>Registrar préstamo</a>
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
                  <th>Empleado</th>
                  <th>Rut</th>
                  <th>Insumo</th>
                  <th>Serial</th>
                  <th>Tipo</th>
                  <th>Cantidad</th>
                  <th>Fecha prestamo</th>
                  <th>Fecha de entrega</th>
                  <th>Status</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($prestamos as $key)
                <tr>
                  <td>{{ $key->nombres }}</td>
                  <td>{{ $key->rut }}</td>
                  <td>{{ $key->producto }} ({{ $key->descripcion }})</td>
                  <td>{{ $key->serial }}</td>
                  <td>{{ $key->tipo }}</td>
                  <td>{{ $key->cantidad }}</td>
                  <td>{{ $key->fecha_prestamo }}</td>
                  <td>{{ $key->fecha_devuelto }}</td>
                  <td>
                    @if($key->status=="Sin Devolver")
                      <span class="badge badge-danger">Sin Devolver</span></td>
                    @elseif($key->status=="Devuelto")
                      <span class="badge badge-success">Devuelto</span></td>
                    @elseif($key->status=="No Aplica")
                      <span class="badge badge-info">No Aplica</span></td>
                    @endif
                    
                  <td>
                    <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar prestamo"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_prestamo"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                @endforeach
                {{-- <tr>
                  <td>Carlos Fuente</td>
                  <td>25498754</td>
                  <td>Lápiz</td>
                  <td>SFG452</td>
                  <td>01/11/2019</td>
                  <td>05/11/2019</td>
                  <td><span class="badge badge-warning">En uso</span></td>
                  <td>
                    <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar prestamo"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_prestamo"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Esteban Colina</td>
                  <td>12457854</td>
                  <td>Computador</td>
                  <td>FG45A4</td>
                  <td>15/11/2019</td>
                  <td>17/11/2019</td>
                  <td><span class="badge badge-success">Entregado</span></td>
                  <td>
                    <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar prestamo"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_prestamo"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Luis Blanco</td>
                  <td>35648754</td>
                  <td>Compresor</td>
                  <td>125478</td>
                  <td>05/12/2019</td>
                  <td>10/12/2019</td>
                  <td><span class="badge badge-danger">Entregado con observaciones</span></td>
                  <td>
                    <a href="" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar prestamo"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_prestamo"><i class="fa fa-trash"></i></button>
                  </td>
                </tr> --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<div class="bs-component">
  <div class="modal" id="eliminar_prestamo">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fa fa-trash"></i> Eliminar prestamo</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <p>¿Estas seguro que desea eliminar a este prestamo?</p>
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
