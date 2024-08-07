<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    use HasFactory;

    public function ventas() {
        return $this->hasMany(Venta::class);
    }

    protected $fillable = ['tipo_comprobante'];
}
