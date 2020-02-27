@extends('layouts.app')
@section('title') Registro de prestamo @endsection
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
      <li class="breadcrumb-item"><a href="{{ url('inventario/prestamos') }}">Prestamos</a></li>
      <li class="breadcrumb-item"><a href="">Registro de prestamo</a></li>
    </ul>
  </div>
  <div class="tile mb-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h2 class="mb-3 line-head" id="indicators">Prestamos</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h4>Registro de prestamo <small>Todos los campos (<b style="color: red;">*</b>) son requeridos.</small></h4>
          <div class="tile-body">
            <form>
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-4 col-xs-12">                  
                  <div class="form-group">
                    <label class="control-label">Solicitantes <b style="color: red;">*</b></label><br>
                    <select name="id_solicitante" id="id_solicitante" class="form-control select2" title="Seleccione el Solicitante">
                      @foreach($solicitantes as $key)
                      <option value="{{ $key->id }}">{{ $key->nombres }} | RUT: {{ $key->rut }} | Status: {{ $key->status }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">                  
                  <div class="form-group">
                    <label class="control-label">Gerencias <b style="color: red;">*</b></label>
                    <select name="id_gerencia" id="id_gerencia" class="form-control" title="Seleccione la gerencia">
                      
                        <option value="0">Seleccione una gerencia</option>
                      @foreach($gerencias as $key)
                      <option value="{{ $key->id }}">{{ $key->gerencia }}</option>
                      @endforeach
                      
                    </select>
                  </div>
                </div>              
              
                <div class="col-lg-5 col-md-8 col-sm-8 col-xs-8">                  
                  <div class="form-group">
                    <label class="control-label">Insumos <b style="color: red;">*</b></label><br>
                    <select name="id_insumo" id="id_insumo" class="form-control select2" title="Seleccione un insumo">
                      
                        {{-- @foreach($insumos as $key)
                          <option value="{{ $key->id }}">{{ $key->producto }} ({{ $key->descripcion }})</option>
                        @endforeach --}}
                      
                    </select>
                  </div>
                </div> 
                </div>
              <div class="row">
                <div class="col-md-3">                  
                  <div class="form-group">
                    <label class="control-label">Tipo de Préstamo <b style="color: red;">*</b></label>
                    <select name="tipo" id="tipo" title="Seleccione el tipo de Préstamo" class="form-control">
                      <option value="Prestar">Prestar</option>
                      <option value="Entregar">Entregar</option>
                    </select>
                  </div>
                </div>
              <div class="col-md-3">                  
                  <div class="form-group">
                    <label class="control-label">Observación</label>
                    <textarea name="observacion" id="observacion" class="form-control" cols="10" rows="5"></textarea>
                  </div>
                </div>
                <div class="col-md-3">                  
                  <div class="form-group">
                    <label class="control-label">Fecha <b style="color: red;">*</b></label>
                    <input class="form-control datepick" type="text" name="fecha_prestamo" id="fecha_prestamo" placeholder="Seleccione la fecha en la que se realiza" max="{{ $hoy }}">
                  </div>
                </div>
                <div class="col-md-3">                  
                  <div class="form-group">
                    <label class="control-label">Cantidad <b style="color: red;">*</b> <small>(Stock)</small></label>
                    <input class="form-control" type="number" name="cantidad" id="cantidad" placeholder="Ingrese cantidad" title="La cantidad no debe superar el máximo disponible del insumo">
                    <small>La cantidad no debe superar el máximo disponible del insumo</small>
                  </div>
                </div>
              </div><hr>
              {{-- <div class="row">
                <div class="col-md-12 text-right">
                  <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-plus"></i>Agregar otro equipo</button>
                </div>
              </div> --}}
            </form>
          </div>
          <div class="tile-footer">
            <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{ url('inventario/prestamos') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Volver</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
@section('scripts')
<script type="text/javascript">

  $("#id_gerencia").on('change',function (event) {
    var id_gerencia=event.target.value;
    //console.log(id_gerencia);
    $.get('/insumos/'+id_gerencia+'/buscar',function (data) {
      //console.log(data.length);
      $("#id_insumo").empty();
      if (data.length>0) {
      $("#id_insumo").append('<optgroup label="Seleccione un Insumo">');
        for(var i=0;i<data.length;i++){
          $("#id_insumo").append('<option value="'+data[i].id+'">'+data[i].producto+' ('+data[i].descripcion+') - Disponibles: '+data[i].disponibles+'</opction>');
        }
      $("#id_insumo").append('</optgroup>');
      }
    })
  })
</script>
@endsection