<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts =[['id' => 1,'province_id' => 6, 'name_en' => 'Ampara'],
            ['id' => 2,'province_id' => 8, 'name_en' => 'Anuradhapura'],
            ['id' => 3,'province_id' => 7, 'name_en' => 'Badulla'],
            ['id' => 4,'province_id' => 6, 'name_en' => 'Batticaloa'],
            ['id' => 5,'province_id' => 1, 'name_en' => 'Colombo'],
            ['id' => 6,'province_id' => 3, 'name_en' => 'Galle'],
            ['id' => 7,'province_id' => 1, 'name_en' => 'Gampaha'],
            ['id' => 8,'province_id' => 3, 'name_en' => 'Hambantota'],
            ['id' => 9,'province_id' => 9, 'name_en' => 'Jaffna'],
            ['id' => 10,'province_id' => 1, 'name_en' => 'Kalutara'],
            ['id' => 11,'province_id' => 2, 'name_en' => 'Kandy'],
            ['id' => 12,'province_id' => 5, 'name_en' => 'Kegalle'],
            ['id' => 13,'province_id' => 9, 'name_en' => 'Kilinochchi'],
            ['id' => 14,'province_id' => 4, 'name_en' => 'Kurunegala'],
            ['id' => 15,'province_id' => 9, 'name_en' => 'Mannar'],
            ['id' => 16,'province_id' => 2, 'name_en' => 'Matale'],
            ['id' => 17,'province_id' => 3, 'name_en' => 'Matara'],
            ['id' => 18,'province_id' => 7, 'name_en' => 'Monaragala'],
            ['id' => 19,'province_id' => 9, 'name_en' => 'Mullaitivu'],
            ['id' => 20,'province_id' => 2, 'name_en' => 'Nuwara Eliya'],
            ['id' => 21,'province_id' => 8, 'name_en' => 'Polonnaruwa'],
            ['id' => 22,'province_id' => 4, 'name_en' => 'Puttalam'],
            ['id' => 23,'province_id' => 5, 'name_en' => 'Ratnapura'],
            ['id' => 24,'province_id' => 6, 'name_en' => 'Trincomalee'],
            ['id' => 25,'province_id' => 9, 'name_en' => 'Vavuniya'],];

            foreach($districts as $district){
                District::create($district);
            }
    }
}
