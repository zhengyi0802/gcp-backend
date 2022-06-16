<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
                'project_id'    => 0,
                'name'       => '教學',
                'tag'        => '教學',
                'type'       => 'video',
                'status'     => true,
                'created_by' => 1,
        );
        Menu::create($data);

        $data = array(
                'project_id'    => 0,
                'name'       => '影音',
                'tag'        => '影音',
                'type'       => 'video',
                'status'     => true,
                'created_by' => 1,
        );
        Menu::create($data);

    }
}
