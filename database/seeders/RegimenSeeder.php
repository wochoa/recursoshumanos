<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class RegimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regimen')->insert([
            ['nom_regimen' => '276 designado'],
            ['nom_regimen' => '276 mandato judicial'],
            ['nom_regimen' => '276 nombrado'],
            ['nom_regimen' => '276 suplencia'],
            ['nom_regimen' => 'CAS directivo'],
            ['nom_regimen' => 'CAS indeterminado'],
            ['nom_regimen' => 'CAS medida cautelar'],
            ['nom_regimen' => 'CAS suplencia'],
            ['nom_regimen' => 'CAS temporal'],
            ['nom_regimen' => 'Practicante'],
            ['nom_regimen' => 'voto popular'],
    ]);
    }
}
