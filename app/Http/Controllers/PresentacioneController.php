<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Caracteristica;
use App\Models\Presentacione;
use Illuminate\Http\Request;

class PresentacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();
        return view('presentaciones.index', compact('presentaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presentaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        $payload = $request->validated();
        $caracteristica = Caracteristica::create($payload);
        $caracteristica->presentacione()->create($payload);
        return redirect()->route('presentaciones.index')->with('success', 'Presentacion registrada correctamente.');
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
    public function edit(Presentacione $presentacione)
    {
        return view('presentaciones.edit', compact('presentacione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Presentacione $presentacione)
    {
        $presentacione->caracteristica()->update(
            $request->validated()
        );

        return redirect()->route('presentaciones.index')->with('success', 'Presentacion actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presentacione $presentacione)
    {
        $presentacione->caracteristica()->update([
            'estado' => !$presentacione->caracteristica->estado
        ]);

        $message = !$presentacione->caracteristica->estado
        ? 'Categoria recuperada correctamente.'
        : 'Categoria eliminada correctamente';

        return redirect()->route('presentaciones.index')->with('success', $message);
    }
}
