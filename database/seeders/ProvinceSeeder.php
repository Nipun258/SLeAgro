<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provice;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces =
            [['id' => 1, 'name_en' => 'Western'],
            ['id' => 2, 'name_en' => 'Central'],
            ['id' => 3, 'name_en' => 'Southern'],
            ['id' => 4, 'name_en' => 'North Western'],
            ['id' => 5, 'name_en' => 'Sabaragamuwa'],
            ['id' => 6, 'name_en' => 'Eastern'],
            ['id' => 7, 'name_en' => 'Uva'],
            ['id' => 8, 'name_en' => 'North Central'],
            ['id' => 9, 'name_en' => 'Northern'],];

            foreach($provinces as $province){
                Provice::create($province);
            }
    }
}
