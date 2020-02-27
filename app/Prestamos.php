<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    protected $table='prestamos';

    protected $fillable=['id_solicitante','id_insumo','tipo','observacion','fecha_prestamo','fecha_entrega','status','cantidad'];

    
}
