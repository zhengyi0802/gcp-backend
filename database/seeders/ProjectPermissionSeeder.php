<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectPermission;
use App\Enums\Permission;

class ProjectPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
               'user_id'     =>  7,
               'project_id'  =>  1,
               'permission'  =>  Permission::Manager,
               'description' =>  null,
               'status'      =>  true,
               'created_by'  =>  1,
        );

        ProjectPermission::create($data);

        $data = array(
               'user_id'     =>  8,
               'project_id'  =>  1,
               'permission'  =>  Permission::Operator,
               'description' =>  null,
               'status'      =>  true,
               'created_by'  =>  1,
        );

        ProjectPermission::create($data);

        $data = array(
               'user_id'     =>  10,
               'project_id'  =>  1,
               'permission'  =>  Permission::Advertiser,
               'description' =>  null,
               'status'      =>  true,
               'created_by'  =>  1,
        );

        ProjectPermission::create($data);

        $data = array(
               'user_id'     =>  11,
               'project_id'  =>  1,
               'permission'  =>  Permission::User,
               'description' =>  null,
               'status'      =>  true,
               'created_by'  =>  1,
        );

        ProjectPermission::create($data);

    }
}
