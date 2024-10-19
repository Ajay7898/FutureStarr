<?php

use Illuminate\Database\Seeder;

class UsersRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = [
			[
				'name' => 'admin',
				'permission' => 'all',
				'created_at' => date('Y-m-d H:i:s'),
			],[
				'name' => 'manager',
				'permission' => 'read,write',
				'created_at' => date('Y-m-d H:i:s'),
			],[
				'name' => 'buyer',
				'permission' => 'read,write',
				'created_at' => date('Y-m-d H:i:s'),
			],[
				'name' => 'seller',
				'permission' => 'read,write',
				'created_at' => date('Y-m-d H:i:s'),
			],
		];

		DB::table('users_roles')->insert($userRoles);
    }
}
