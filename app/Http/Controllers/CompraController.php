<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompraRequest;
use App\Models\Compra;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\Proveedore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('comprobante', 'proveedore.persona')
            ->where('estado', 1)
            ->latest()
            ->get();
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedore::whereHas('persona', function ($query) {
            $query->where('estado', 1);
        })->get();
        $comprobantes = Comprobante::all();
        $productos = Producto::where('estado', 1)->get();
        return view('compras.create', compact('proveedores', 'comprobantes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        $arrayProductoId = $request->get('arrayidproducto');
        $arrayCantidad = $request->get('arraycantidad');
        $arrayPrecioCompra = $request->get('arraypreciocompra');
        $arrayPrecioVenta = $request->get('arrayprecioventa');
        
        $compra = Compra::create($request->validated());
        
        $sizeArray = count($arrayProductoId);
        $count = 0;

        while($count < $sizeArray) {
            $compra->productos()->syncWithoutDetaching([
                $arrayProductoId[$count] => [
                    'cantidad'  => $arrayCantidad[$count],
                    'precio_compra'  => $arrayPrecioCompra[$count],
                    'precio_venta'  => $arrayPrecioVenta[$count],
                ]
            ]);

            $currentProduct = Producto::find($arrayProductoId[$count]);
            $currentStock = $currentProduct->stock;
            $newStock = intval($arrayCantidad[$count]);

            DB::table('productos')
            ->where('id', $currentProduct->id)
            ->update([
                'stock' => $currentStock + $newStock
            ]);

            $count += 1;
        }

        return redirect()->route('compras.index')->with('success', 'Compra registradas correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        $currentState = $compra->estado;
        $compra->estado = !$currentState;
        $compra->save();

        $message = !$currentState
        ? 'Compra recuperada correctamente.'
        : 'Compra eliminada correctamente';

        return redirect()->route('compras.index')->with('success', $message);
    }
}
