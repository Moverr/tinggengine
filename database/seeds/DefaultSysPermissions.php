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


        DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'FETCH ONLY OWN RECORDS',
            'code' => 'FOOR'
        ]);
        DB::table('permissions')->insert([
            'id' => 3,
            'name' => 'FETCH OWN AND CHILDREN RECORDS',
            'code' => 'FOACR'
        ]);


        //categories
        DB::table('permissions')->insert([
            'id' => 3,
            'name' => 'CREATE PRODUCT CATEGORIES',
            'code' => 'CPG'
        ]);
        DB::table('permissions')->insert([
            'id' => 4,
            'name' => 'EDIT PRODUCT CATEGORIES',
            'code' => 'EPG'
        ]);
        DB::table('permissions')->insert([
            'id' => 5,
            'name' => 'ARCHIVE PRODUCT CATEGORIES',
            'code' => 'APG'
        ]);
        DB::table('permissions')->insert([
            'id' => 6,
            'name' => 'LIST PRODUCT CATEGORIES',
            'code' => 'LPG'
        ]);
        DB::table('permissions')->insert([
            'id' => 7,
            'name' => 'GET PRODUCT CATEGORIES',
            'code' => 'GPG'
        ]);


        //products
        DB::table('permissions')->insert([
            'id' => 9,
            'name' => 'CREATE PRODUCT ',
            'code' => 'CP'
        ]);
        DB::table('permissions')->insert([
            'id' => 10,
            'name' => 'EDIT PRODUCT ',
            'code' => 'EP'
        ]);
        DB::table('permissions')->insert([
            'id' => 11,
            'name' => 'ARCHIVE PRODUCT ',
            'code' => 'AP'
        ]);
        DB::table('permissions')->insert([
            'id' => 12,
            'name' => 'LIST PRODUCT ',
            'code' => 'LP'
        ]);
        DB::table('permissions')->insert([
            'id' => 13,
            'name' => 'GET PRODUCT ',
            'code' => 'GP'
        ]);



        //products
        DB::table('permissions')->insert([
            'id' => 14,
            'name' => 'CREATE PRODUCT ',
            'code' => 'CP'
        ]);
        DB::table('permissions')->insert([
            'id' => 15,
            'name' => 'EDIT PRODUCT ',
            'code' => 'EP'
        ]);
        DB::table('permissions')->insert([
            'id' => 16,
            'name' => 'ARCHIVE PRODUCT ',
            'code' => 'AP'
        ]);
        DB::table('permissions')->insert([
            'id' => 17,
            'name' => 'LIST PRODUCT ',
            'code' => 'LP'
        ]);
        DB::table('permissions')->insert([
            'id' => 18,
            'name' => 'GET PRODUCT ',
            'code' => 'GP'
        ]);



          //stockist
        DB::table('permissions')->insert([
            'id' => 19,
            'name' => 'CREATE STOCKIST',
            'code' => 'CSTST'
        ]);
        DB::table('permissions')->insert([
            'id' => 20,
            'name' => 'EDIT STOCKIST ',
            'code' => 'ESTST'
        ]);
        DB::table('permissions')->insert([
            'id' => 21,
            'name' => 'ARCHIVE STOCKIST ',
            'code' => 'ASTST'
        ]);
        DB::table('permissions')->insert([
            'id' => 22,
            'name' => 'LIST STOCKIST ',
            'code' => 'LSTST'
        ]);
        DB::table('permissions')->insert([
            'id' => 23,
            'name' => 'GET STOCKIST ',
            'code' => 'GSTST'
        ]);



          //stockist
        DB::table('permissions')->insert([
            'id' => 24,
            'name' => 'CREATE PROFILE',
            'code' => 'CPRL'
        ]);
        DB::table('permissions')->insert([
            'id' => 25,
            'name' => 'EDIT PROFILE ',
            'code' => 'EPRL'
        ]);
        DB::table('permissions')->insert([
            'id' => 26,
            'name' => 'ARCHIVE PROFILE ',
            'code' => 'APRL'
        ]);
        DB::table('permissions')->insert([
            'id' => 27,
            'name' => 'LIST PROFILE ',
            'code' => 'LPRL'
        ]);
        DB::table('permissions')->insert([
            'id' => 28,
            'name' => 'GET PROFILE ',
            'code' => 'GPRL'
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
            'id' => 1,
            'username' => 'admin',
            'password' => sha1('admin@123'),
            'status' => 'ACTIVE',
            'group' => 'ADMINISTRATOR'
        ]);


        DB::table('userrole')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }

}
