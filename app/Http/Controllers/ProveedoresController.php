<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Document;
use App\Models\Persona;
use App\Models\Proveedore;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedore::with(['persona.documento'])->get();
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Document::all();
        return view('proveedores.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        $persona = Persona::create($request->validated());
        $persona->proveedore()->create();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado');
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
    public function edit(Proveedore $proveedore)
    {
        $documentos = Document::all();
        $proveedore->load('persona.documento');
        return view('proveedores.edit', compact('proveedore', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonaRequest $request, Proveedore $proveedore)
    {
        $proveedore->persona->update($request->validated());
        return redirect()->route('proveedores.index')->with('success', 'Se actualizo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedore $proveedore)
    {
        $proveedore->persona()->update([
            'estado' => !$proveedore->persona->estado
        ]);

        $message = !$proveedore->persona->estado
        ? 'Proveedor recuperado correctamente.'
        : 'Proveedor eliminado correctamente';

        return redirect()->route('proveedores.index')->with('success', $message);
    }
}
