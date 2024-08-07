<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::insert([
            ['tipo_documento'    => 'DNI'],
            ['tipo_documento'    => 'Pasaporte'],
            ['tipo_documento'    => 'RUC'],
            ['tipo_documento'    => 'Carnet']
        ]);
    }
}
