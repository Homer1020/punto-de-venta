<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Caracteristica;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::with('caracteristica')->latest()->get();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        $payload = $request->validated();
        $caracteristica = Caracteristica::create($payload);
        $caracteristica->categoria()->create();
        return redirect()->route('categorias.index')->with('success', 'Categoria registrada correctamente.');
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
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->caracteristica()->update(
            $request->validated()
        );

        return redirect()->route('categorias.index')->with('success', 'Categoria actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->caracteristica()->update([
            'estado' => !$categoria->caracteristica->estado
        ]);

        $message = !$categoria->caracteristica->estado
        ? 'Categorua recuperada correctamente.'
        : 'Categoria eliminada correctamente';

        return redirect()->route('categorias.index')->with('success', $message);
    }
}
