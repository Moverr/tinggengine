<?php

use Illuminate\Database\Seeder;

class DefaultSysPermissions extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'ALL_FUNCTIONS',
            'code' => 'ALL_FUNCTIONS'
        ]);

        


        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'SUPER_ADMIN',
            'code' => 'ADMIN',
            'description' => 'ADMIN',
            'status' => 'ACTIVE',
            'is_system' => 1
        ]);

        DB::table('rolepermission')->insert([
            'role_id' => 1,
            'permission_id' => 1
        ]);
        
         
        
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => sha1('admin@123'),
            'status' => 'ACTIVE',
            'group' => 'ADMINISTRATOR',
            
        ]);
        
        
    }

}
