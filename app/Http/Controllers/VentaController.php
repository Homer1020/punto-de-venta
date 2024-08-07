<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\Venta;
use App\Http\Requests\StoreVentaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with([
            'comprobante',
            'cliente.persona',
            'user'
        ])
        ->where('estado', 1)
        ->latest()
        ->get();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subquery = DB::table('compra_producto')
            ->select('producto_id', DB::raw('MAX(created_at) as max_created_at'))
            ->groupBy('producto_id');

        $productos = Producto::join('compra_producto as cpr', function ($join) use ($subquery) {
            $join->on('cpr.producto_id', '=', 'productos.id')
                ->whereIn('cpr.created_at', function ($query) use ($subquery) {
                    $query->select('max_created_at')
                        ->fromSub($subquery, 'subquery')
                        ->whereRaw('subquery.producto_id = cpr.producto_id');
                });
        })
            ->select('productos.nombre', 'productos.id', 'productos.stock', 'cpr.precio_venta')
            ->where('productos.estado', 1)
            ->where('productos.stock', '>', 0)
            ->get();

        $clientes = Cliente::whereHas('persona', function ($query) {
            $query->where('estado', 1);
        })->get();
        $comprobantes = Comprobante::all();
        return view('ventas.create', compact('productos', 'clientes', 'comprobantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVentaRequest $request)
    {
        // return $request;
        $venta = Venta::create($request->validated());
        
        $arrayProductoId = $request->get('arrayidproducto');
        $arrayCantidad = $request->get('arraycantidad');
        $arrayPrecioVenta = $request->get('arrayprecioventa');
        $arrayDescuento = $request->get('arraydescuento');

        $sizeArray = count($arrayProductoId);
        $count = 0;

        while($count < $sizeArray) {
            $venta->productos()->syncWithoutDetaching([
                $arrayProductoId[$count] => [
                    'cantidad'          => $arrayCantidad[$count],
                    'precio_venta'      => $arrayPrecioVenta[$count],
                    'descuento'         => $arrayDescuento[$count]
                ]
            ]);

            // update stock
            $producto = Producto::find($arrayProductoId[$count]);
            $currentStock = $producto->stock;
            $cantidad = intval($arrayCantidad[$count]);
            $newStock = $currentStock - $cantidad;

            DB::table('productos')
                ->where('id', $producto->id)
                ->update([
                    'stock' => $newStock
                ]);

            $count = $count + 1;
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registradas correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
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
    public function destroy(Venta $venta)
    {
        $currentState = $venta->estado;
        $venta->estado = !$currentState;
        $venta->save();

        $message = !$currentState
        ? 'Venta recuperada correctamente.'
        : 'Venta eliminada correctamente';

        return redirect()->route('ventas.index')->with('success', $message);
    }
}
