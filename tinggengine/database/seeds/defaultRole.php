<?php

use Illuminate\Database\Seeder;

class defaultRole extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'SUPER ADMINISTRATOR',
            'code' => 'SA',
            'description' => 'SUPER ADMINISTRATOR ROLE,HAS CAPACITY OVER THE ENTIRE SYSTEM',
            'status' => 'ACTIVE',
            'is_system' => TRUE
        ]);

        DB::table('rolepermission')->insert([
            'id' => 1,
            'role_id' => 1,
            'permission_id' => 1
        ]);
    }

}
