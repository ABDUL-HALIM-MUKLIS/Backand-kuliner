<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\SubDistrict;
use Illuminate\Database\Seeder;

class SubDistricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Sidoarjo',
            'Balongbendo',
            'Buduran',
            'Candi',
            'Gedangan',
            'Jabon',
            'Krembung',
            'Krian',
            'Prambon',
            'Porong',
            'Sedati',
            'Sukodono',
            'Taman',
            'Tanggulangin',
            'Tarik',
            'Tulangan',
            'Waru',
            'Wonoayu',
        ];

        foreach ($datas as $dta){
            SubDistrict::create([
                'name' => $dta,
                'slug' => Str::slug($dta),
            ]);
        }
    }
}
