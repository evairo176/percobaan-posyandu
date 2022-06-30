<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_website')->delete();

        $website = [
            [
                'judul' => 'Dinas Pemberdayaan Manusia dan Desa',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit provident inventore dicta magni odio animi accusamus natus. Ut facere sunt nisi nihil illo molestias corrupti.',
                'picture' => 'website.webp',
            ],
        ];

        Website::insert($website);
    }
}
