<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacione extends Model
{
    use HasFactory;

    protected $fillable = ['caracteristica_id'];

    public function productos() {
        return $this->hasOne(Producto::class);
    }

    public function caracteristica() {
        return $this->belongsTo(Caracteristica::class);
    }
}
