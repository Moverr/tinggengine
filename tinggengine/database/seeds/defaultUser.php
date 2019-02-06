<?php

use Illuminate\Database\Seeder;

class defaultUser extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'admin',
            'password' => sha1("admin123")
        ]);

        DB::table('userrole')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }

}
