<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    use HasFactory;

    public function compras() {
        return $this
            ->belongsToMany(Compra::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_compra', 'precio_venta');
    }

    public function ventas() {
        return $this
            ->belongsToMany(Venta::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_venta', 'descuento');
    }

    public function categorias() {
        return $this
            ->belongsToMany(Categoria::class)
            ->withTimestamps();
    }

    public function marca() {
        return $this->belongsTo(Marca::class);
    }

    public function presentacione() {
        return $this->belongsTo(Presentacione::class);
    }

    protected $fillable = ['codigo', 'nombre', 'descripcion', 'fecha_vencimiento', 'marca_id', 'presentacione_id', 'img_path', 'estado'];

    public function handledUploadImage($image) {
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        Storage::putFileAs('/public/productos', $file, $name, 'public');
        // $file->move(public_path() . '/img/productos/' . $name);
        return $name;
    }
}
