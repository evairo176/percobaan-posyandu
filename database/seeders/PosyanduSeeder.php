<?php

namespace Database\Seeders;

use App\Models\Posyandu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_rekap_posyandu')->delete();

        $website = [
            [
                'nama_posyandu' => 'posyandu melati',
                'blok' => 'karangasem tengah',
                'rt' => '07',
                'rw' => '02',
                'kelurahan' => 'Bojongsari',
                'kecamatan' => 'Indramayu',
                'kabupaten' => 'Indramayu',
            ],
        ];

        Posyandu::insert($website);
    }
}
