<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
               'name'           => '預設專案',
               'company'        => '響樂科技',
               'description'    => '預設專案',
               'status'         => true,
               'start_time'     => null,
               'stop_time'      => null,
               'created_by'     => 1,
        );
        Project::create($data);
    }
}
