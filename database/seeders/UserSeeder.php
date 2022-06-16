<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $userdata = array(
                  [
                      'name'        => 'System',
                      'email'       => 'system@mdo.tw',
                      'password'    => bcrypt('0000000000'),
                      'role'        => UserRole::System,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
                  [
                      'name'        => 'RemoteAPI',
                      'email'       => 'remote@mdo.tw',
                      'password'    => bcrypt('0000000000'),
                      'role'        => UserRole::System,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
                  [
                      'name'        => 'Admin',
                      'email'       => 'admin@mdo.tw',
                      'password'    => bcrypt('12345678'),
                      'role'        => UserRole::Administrator,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
                  [
                      'name'        => 'Engineer',
                      'email'       => 'engineer@mdo.tw',
                      'password'    => bcrypt('mundi1234'),
                      'role'        => UserRole::Developer,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
                  [
                      'name'        => 'App Engineer',
                      'email'       => 'engineer2@mdo.tw',
                      'password'    => bcrypt('joylife1234'),
                      'role'        => UserRole::Developer,
                      'status'      => true,
                      'created_by'  => 1,
                  ],
                  [
                      'name'        => 'MainManager',
                      'email'       => 'main_manager@mdo.tw',
                      'password'    => bcrypt('joylife1234'),
                      'role'        => UserRole::MainManager,
                      'status'      => true,
                      'created_by'  => 4,
                  ],
                  [
                      'name'        => 'Manager 1',
                      'email'       => 'manager1@mdo.tw',
                      'password'    => bcrypt('joylife1234'),
                      'role'        => UserRole::Manager,
                      'status'      => true,
                      'created_by'  => 4,
                  ],
                  [
                      'name'        => 'Operator 1',
                      'email'       => 'operator1@mdo.tw',
                      'password'    => bcrypt('joylife1234'),
                      'role'        => UserRole::Operator,
                      'status'      => true,
                      'created_by'  => 4,
                  ],
                  [
                      'name'        => 'Reseller 1',
                      'email'       => 'reseller1@mdo.tw',
                      'password'    => bcrypt('joylife1234'),
                      'role'        => UserRole::Reseller,
                      'status'      => true,
                      'created_by'  => 4,
                  ],
                  [
                      'name'        => 'Advertiser 1',
                      'email'       => 'advertiser1@mdo.tw',
                      'password'    => bcrypt('joylife1234'),
                      'role'        => UserRole::Advertiser,
                      'status'      => true,
                      'created_by'  => 4,
                  ],
                  [
                      'name'        => 'User 1',
                      'email'       => 'user1@mdo.tw',
                      'password'    => bcrypt('joylife1234'),
                      'role'        => UserRole::User,
                      'status'      => true,
                      'created_by'  => 4,
                  ],
              );
        foreach($userdata as $user) {
            User::create($user);
        }
    }
}
