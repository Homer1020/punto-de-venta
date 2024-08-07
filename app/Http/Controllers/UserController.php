<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $passwordHash = Hash::make($request->input('password'));

        $request->merge(['password' => $passwordHash]);

        $user = User::create($request->all());

        $user->assignRole($request->get('role'));

        return redirect()->route('users.index')->with('success', 'Usuario registrado');
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
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(empty($request->password)) {
            $request = Arr::except($request, array('password'));
        } else {
            $passwordHash = Hash::make($request->input('password'));
            $request->merge(['password' => $passwordHash]);
        }
        $user->update($request->all());
        
        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'Usuario editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $rolUser = $user->getRoleNames()->first();
        $user->removeRole($rolUser);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado');
    }
}
