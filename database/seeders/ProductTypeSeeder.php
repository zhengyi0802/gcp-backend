<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            'catagory_id'  => 2,
            'name'         => 'M3',
            'description'  => 'M3 Soundbar',
            'created_by'   => 1,
        );
        ProductType::create($data);

        $data = array(
            'catagory_id'  => 2,
            'name'         => 'M5',
            'description'  => 'M5 Soundbar',
            'created_by'   => 1,
        );
        ProductType::create($data);

        $data = array(
            'catagory_id'  => 2,
            'name'         => 'A3',
            'description'  => 'A3 Soundbar',
            'created_by'   => 1,
        );
        ProductType::create($data);

        $data = array(
            'catagory_id'  => 2,
            'name'         => 'A5',
            'description'  => 'A5 Soundbar',
            'created_by'   => 1,
        );
        ProductType::create($data);
    }
}
