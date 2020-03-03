<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    protected $table='insumos';

    protected $fillable=['producto','descripcion','serial','modelo','modulo','id_gerencia','ubicacion','existencia','in_almacen','out_almacen','disponibles','entregados','en_reparacion','inservible'];

    public function gerencias()
    {
    	return $this->belongsTo('App\Gerencias','id_gerencia');
    }

    public function prestamos()
    {
    	return $this->hasMany('App\Solicitantes','prestamos','id_insumo','id_solicitante')->withPivot('tipo','observacion','fecha_prestamo','fecha_devuelto','status','cantidad');
    }
}
