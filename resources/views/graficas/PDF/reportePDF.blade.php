<!DOCTYPE html>
<html>
<head>
	<title>Reporte de insumos PDF</title>
</head>
<body style="width: 100%;">
	<hr>
	<h2>Estado actual del almacén</h2>
	<table border="1px" width="100%">
		<thead>
			<tr>
				<th>Nro.</th>
				<th>Insumo</th>
				<th>En el almacén</th>
				<th>Fuera del almacén</th>
				<th>Disponibles</th>
				<th>Entregados</th>
				<th>En reparación</th>
				<th>Inservible</th>
			</tr>
		</thead>
		<tbody>
			{{$num=0}}
			@foreach($insumos as $key)
				<tr>
					<td>{{$num=$num+1}}</td>
					<td>{{$key->producto}}</td>
					<td>{{$key->in_almacen}}</td>
					<td>{{$key->out_almacen}}</td>
					<td>{{$key->disponibles}}</td>
					<td>{{$key->entregados}}</td>
					<td>{{$key->en_reparacion}}</td>
					<td>{{$key->inservible}}</td>
				</tr>
			@endforeach()
		</tbody>
	</table>
	<br>
	<hr>
	<h2>Prestamos realizados
	</h2>
	<table border="1px" width="100%">
		<thead>
			<tr>
				<th>Nro.</th>
				<th>Solicitante</th>
				<th>Insumo</th>
				<th>Tipo</th>
				<th>Observación</th>
				<th>Status</th>
				<th>Cantidad</th>
			</tr>
		</thead>
		<tbody>
			{{$num=0}}
			@foreach($prestamos as $key)
				<tr>
					<td>{{$num=$num+1}}</td>
					<td>{{$key->solicitantes->nombres}} - {{$key->solicitantes->rut}}</td>
					<td>{{$key->insumos->producto}}</td>
					<td>{{$key->tipo}}</td>
					<td>{{$key->observación}}</td>
					<td>{{$key->status}}</td>
					<td>{{$key->cantidad}}</td>
				</tr>
			@endforeach()
		</tbody>
	</table>

	<br>
	<hr>
	<h2>Incidencias reportadas
	</h2>
	<table border="1px" width="100%">
		<thead>
			<tr>
				<th>Nro.</th>
				<th>Insumo</th>
				<th>Cantidad</th>
				<th>Tipo</th>
				<th>Observación</th>
				<th>Fecha de la incidencia</th>
			</tr>
		</thead>
		<tbody>
			{{$num=0}}
			@foreach($incidencias as $key)
				<tr>
					<td>{{$num=$num+1}}</td>
					<td>{{$key->insumos->producto}}</td>
					<td>{{$key->cantidad}}</td>
					<td>{{$key->tipo}}</td>
					<td>{{$key->fecha_incidencia}}</td>
					<td>{{$key->status}}</td>
				</tr>
			@endforeach()
		</tbody>
	</table>
</body>
</html>