@extends('layouts.app')
@section('title') Insumos @endsection
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Inventario</h1>
      <p>Sistema de Inventario | Licancabur</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Inventario</a></li>
      <li class="breadcrumb-item"><a href="{{ route('insumos.index') }}">Insumos</a></li>
      <li class="breadcrumb-item"><a href="#">Listado</a></li>
    </ul>
  </div>
  <div class="tile mb-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h2 class="mb-3 line-head" id="indicators">Insumos
            <a class="btn btn-primary icon-btn pull-right" href="{{ route('insumos.create') }}"><i class="fa fa-plus"></i>Registrar insumo</a>
          </h2>
        </div>
        <div class="basic-tb-hd text-center">
          
          @if(count($errors))
          <div class="alert-list m-4">
              <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                  <ul>
                      @foreach($errors->all() as $error)
                      <li>
                          {{$error}}
                      </li>
                      @endforeach

                  </ul>
              </div>
          </div>
          @endif
          @include('flash::message')
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Descripción</th>
                  <th>Serial</th>
                  <th>Modelo</th>
                  <th>Módulo</th>
                  <th>Gerencia</th>
                  <th>Ubicación</th>
                  <th>Existencia</th>
                  <th>En Almacén</th>
                  <th>Fuera de Almacén</th>
                  <th>Disponibles</th>
                  {{-- <th>Entregados</th> --}}
                  {{-- <th>En Reparación</th> --}}
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($insumos as $key)
                <tr title="Entregados: {{ $key->entregados }} - En Reparación: {{ $key->en_reparacion }} - InserviBles: {{ $key->inservible }}">
                  <td>{{ $key->producto }}</td>
                  <td>{{ $key->descripcion }}</td>
                  <td>{{ $key->serial }}</td>
                  <td>{{ $key->modelo }}</td>
                  <td>{{ $key->modulo }}</td>
                  <td>{{ $key->gerencias->gerencia }}</td>
                  <td>{{ $key->ubicacion }}</td>
                  <td>{{ $key->existencia }}</td>
                  <td>{{ $key->in_almacen }}</td>
                  <td>{{ $key->out_almacen }}</td>
                  <td>{{ $key->disponibles }}</td>
                  {{-- <td>{{ $key->entregados }}</td> --}}
                  {{-- <td>{{ $key->en_reparacion }}</td> --}}

                  <td>
                    <a href="{{ route('insumos.edit',$key->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Editar Insumo"><i class="fa fa-edit"></i></a>
                    <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_insumo" onclick="eliminar('{{ $key->id }}')"><i class="fa fa-trash"></i></a>
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detalles" onclick="detalles('{{ $key->producto }}','{{ $key->descripcion }}','{{ $key->serial }}','{{ $key->modelo }}','{{ $key->modulo }}','{{ $key->gerencias->gerencia }}','{{ $key->ubicacion }}','{{ $key->existencia }}','{{ $key->in_almacen }}','{{ $key->out_almacen }}','{{ $key->disponibles }}','{{ $key->entregados }}','{{ $key->en_reparacion }}','{{ $key->inservible }}')"><i class="fa fa-eye"></i></a>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<div class="bs-component">
  <div class="modal" id="eliminar_insumo">
    <div class="modal-dialog modal-dialog_1" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><i class="fa fa-trash"></i> Eliminar Insumo</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          {!! Form::open(['route' => ['insumos.destroy',1033], 'method' => 'DELETE']) !!}
                <div class="modal-body">
                  <h2>¿Esta seguro que desea eliminar este insumo?</h2>
                <p>Esta acción no se podra deshacer en el futuro.</p>
                    <input type="hidden" name="id_insumo" id="id_insumo" >
                    <div class="row form-group">
                        <div class="col col-md-1">
                        </div>
                    </div>
                </div>

          <div class="modal-footer">
            <button class="btn btn-danger" type="submit">Eliminar</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
          </div>          
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

{{-- ver detalles --}}

<div class="bs-component">
  <div class="modal" id="detalles">
    <div class="modal-dialog modal-dialog_1" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><i class="fa fa-eye"></i> Detalles del Insumo</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <tr>
                    <th>Nombre:</th>
                    <td><span id="producto"></span></td>
                    <th>Existencia</th>
                    <td><span id="existencia"></span></td>
                  </tr>
                  <tr>
                    <th>Descripción</th>
                    <td><span id="descripcion"></span></td>
                    <th>En Almacen</th>
                    <td><span id="in_almacen"></span></td>
                  </tr>
                  <tr>
                    <th>Serial</th>
                    <td><span id="serial"></span></td>
                    <th>Entregados</th>
                    <td><span id="entregados"></span></td>
                  </tr>
                  <tr>
                    <th>Modelo</th>
                    <td><span id="modelo"></span></td>
                    <th>Fuera de Almacén</th>
                    <td><span id="out_almacen"></span></td>
                  </tr>
                  <tr>
                    <th>Módulo</th>
                    <td><span id="modulo"></span></td>
                    <th>Disponibles</th>
                    <td><span id="disponibles"></span></td>
                  </tr>
                  <tr>
                    <th>Gerencia</th>
                    <td><span id="gerencia"></span></td>
                    <th>En Reparación</th>
                    <td><span id="en_reparacion"></span></td>
                  </tr>
                  <tr>
                    <th>Ubicación</th>
                    <td><span id="ubicacion"></span></td>
                    <th>Inservibles</th>
                    <td><span id="inservible"></span></td>
                  </tr>
                </table>
              </div>
            </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
          </div>          
        
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  function eliminar(id_insumo) {
    $("#id_insumo").val(id_insumo);
  }

  function detalles(producto,descripcion,serial,modelo,modulo,gerencia,ubicacion,existencia,in_almacen,out_almacen,disponibles,entregados,en_reparacion,inservible) {
    $("#producto").text(producto);
    $("#descripcion").text(descripcion);
    $("#serial").text(serial);
    $("#modelo").text(modelo);
    $("#modulo").text(modulo);
    $("#gerencia").text(gerencia);
    $("#ubicacion").text(ubicacion);
    $("#existencia").text(existencia);
    $("#in_almacen").text(in_almacen);
    $("#out_almacen").text(out_almacen);
    $("#disponibles").text(disponibles);
    $("#entregados").text(entregados);
    $("#en_reparacion").text(en_reparacion);
    $("#inservible").text(inservible);
  }
</script>
@endsection