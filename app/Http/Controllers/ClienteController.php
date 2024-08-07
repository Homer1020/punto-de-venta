<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Cliente;
use App\Models\Document;
use App\Models\Persona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::with(['persona.documento'])->get();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Document::all();
        return view('clientes.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        $persona = Persona::create($request->validated());
        $persona->cliente()->create();
        return redirect()->route('clientes.index')->with('success', 'Cliente registrado');
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
    public function edit(Cliente $cliente)
    {
        $documentos = Document::all();
        $cliente->load('persona.documento');
        return view('clientes.edit', compact('documentos', 'cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonaRequest $request, Cliente $cliente)
    {
        $cliente->persona->update($request->validated());
        return redirect()->route('clientes.index')->with('success', 'Se actualizo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->persona()->update([
            'estado' => !$cliente->persona->estado
        ]);

        $message = !$cliente->persona->estado
        ? 'Categoria recuperada correctamente.'
        : 'Categoria eliminada correctamente';

        return redirect()->route('clientes.index')->with('success', $message);
    }
}
