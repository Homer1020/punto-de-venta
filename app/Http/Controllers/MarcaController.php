<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Caracteristica;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::with('caracteristica')->latest()->get();
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        $payload = $request->validated();
        $caracteristica = Caracteristica::create($payload);
        $caracteristica->marca()->create();
        return redirect()->route('marcas.index')->with('success', 'Marca guardada correctamente.');
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
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Marca $marca)
    {
        $marca->caracteristica()->update(
            $request->validated()
        );

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        $marca->caracteristica()->update([
            'estado' => !$marca->caracteristica->estado
        ]);

        $message = !$marca->caracteristica->estado
        ? 'Marca recuperada correctamente.'
        : 'Marca eliminada correctamente';

        return redirect()->route('marcas.index')->with('success', $message);
    }
}
