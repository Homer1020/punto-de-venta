<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Presentacione;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with(['categorias.caracteristica', 'marca.caracteristica', 'presentacione.caracteristica'])->latest()->get();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::whereHas('caracteristica', function($query) {
            return $query->where('estado', true);
        })->get();

        $presentaciones = Presentacione::whereHas('caracteristica', function($query) {
            return $query->where('estado', true);
        })->get();

        $categorias = Categoria::whereHas('caracteristica', function($query) {
            return $query->where('estado', true);
        })->get();

        return view('productos.create', compact('marcas', 'presentaciones', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $producto = new Producto();

        if($request->hasFile('img_path')) {
            $name = $producto->handledUploadImage($request->file('img_path'));
        } else {
            $name = null;
        }

        $producto->fill([
            'codigo'            => $request->codigo,
            'nombre'            => $request->nombre,
            'img_path'          => $name,
            'descripcion'       => $request->descripcion,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'marca_id'          => $request->marca_id,
            'presentacione_id'  => $request->presentacione_id
        ]);

        $producto->save();

        $categorias = $request->get('categorias');
        $producto->categorias()->attach($categorias);

        return redirect()->route('productos.index')->with('success', 'Producto guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $marcas = Marca::whereHas('caracteristica', function($query) {
            return $query->where('estado', true);
        })->get();

        $presentaciones = Presentacione::whereHas('caracteristica', function($query) {
            return $query->where('estado', true);
        })->get();

        $categorias = Categoria::whereHas('caracteristica', function($query) {
            return $query->where('estado', true);
        })->get();

        return view('productos.edit', compact('producto', 'marcas', 'presentaciones', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        if($request->hasFile('img_path')) {
            $name = $producto->handledUploadImage($request->file('img_path'));

            if(Storage::disk('public')->exists('/productos/' . $producto->img_path)) {
                Storage::disk('public')->delete('/productos/' . $producto->img_path);
            }
        } else {
            $name = $producto->img_path;
        }

        $producto->fill([
            'codigo'            => $request->codigo,
            'nombre'            => $request->nombre,
            'img_path'          => $name,
            'descripcion'       => $request->descripcion,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'marca_id'          => $request->marca_id,
            'presentacione_id'  => $request->presentacione_id
        ]);

        $producto->save();

        $categorias = $request->get('categorias');
        $producto->categorias()->sync($categorias);

        return redirect()->route('productos.index')->with('success', 'Producto editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->update([
            'estado' => !$producto->estado
        ]);

        $message = !$producto->estado
        ? 'Producto recuperado correctamente.'
        : 'Producto eliminado correctamente';

        return redirect()->route('productos.index')->with('success', $message);
    }
}
