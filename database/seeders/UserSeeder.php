<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::create([
        //     'name'      => 'Homer',
        //     'email'     => 'admin@gmail.com',
        //     'password'  => bcrypt('admin123')
        // ]);

        $user = User::find(1);

        $rol = Role::create(['name' => 'administrador']);
        $permisos = Permission::pluck('id', 'id')->all();
        $rol->syncPermissions($permisos);
        $user->assignRole('administrador');
    }
}
