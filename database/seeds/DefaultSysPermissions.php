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





        //stockist
        DB::table('permissions')->insert([
            'id' => 29,
            'name' => 'CREATE PURCHASE',
            'code' => 'CPUR'
        ]);
        DB::table('permissions')->insert([
            'id' => 30,
            'name' => 'EDIT PURCHASE ',
            'code' => 'EPUR'
        ]);
        DB::table('permissions')->insert([
            'id' => 31,
            'name' => 'ARCHIVE PURCHASE ',
            'code' => 'APUR'
        ]);
        DB::table('permissions')->insert([
            'id' => 32,
            'name' => 'LIST PURCHASE ',
            'code' => 'LPUR'
        ]);
        DB::table('permissions')->insert([
            'id' => 33,
            'name' => 'GET PURCHASE ',
            'code' => 'GPUR'
        ]);




        //stockist
        DB::table('permissions')->insert([
            'id' => 34,
            'name' => 'CREATE ROLE',
            'code' => 'CROLE'
        ]);
        DB::table('permissions')->insert([
            'id' => 35,
            'name' => 'EDIT ROLE ',
            'code' => 'EROLE'
        ]);
        DB::table('permissions')->insert([
            'id' => 36,
            'name' => 'ARCHIVE ROLE ',
            'code' => 'AROLE'
        ]);
        DB::table('permissions')->insert([
            'id' => 37,
            'name' => 'LIST ROLE ',
            'code' => 'LROLE'
        ]);
        DB::table('permissions')->insert([
            'id' => 38,
            'name' => 'GET ROLE ',
            'code' => 'GROLE'
        ]);







        //dealer
        DB::table('permissions')->insert([
            'id' => 39,
            'name' => 'CREATE DEALER ',
            'code' => 'CDEALER'
        ]);
        DB::table('permissions')->insert([
            'id' => 40,
            'name' => 'EDIT DEALER ',
            'code' => 'EDEALER'
        ]);
        DB::table('permissions')->insert([
            'id' => 41,
            'name' => 'ARCHIVE DEALER ',
            'code' => 'ADEALER'
        ]);
        DB::table('permissions')->insert([
            'id' => 42,
            'name' => 'LIST DEALER ',
            'code' => 'LDEALER'
        ]);
        DB::table('permissions')->insert([
            'id' => 43,
            'name' => 'GET DEALER ',
            'code' => 'GDEALER'
        ]);








        //dealer
        DB::table('permissions')->insert([
            'id' => 44,
            'name' => 'CREATE DRIVER ',
            'code' => 'CDRIVER'
        ]);
        DB::table('permissions')->insert([
            'id' => 45,
            'name' => 'EDIT DRIVER ',
            'code' => 'EDRIVER'
        ]);
        DB::table('permissions')->insert([
            'id' => 46,
            'name' => 'ARCHIVE DRIVER ',
            'code' => 'ADRIVER'
        ]);
        DB::table('permissions')->insert([
            'id' => 47,
            'name' => 'LIST DRIVER ',
            'code' => 'LDRIVER'
        ]);
        DB::table('permissions')->insert([
            'id' => 48,
            'name' => 'GET DRIVER ',
            'code' => 'GDRIVER'
        ]);




        //dealer
        DB::table('permissions')->insert([
            'id' => 44,
            'name' => 'CREATE STOCKIST ',
            'code' => 'CSTOCKIST'
        ]);
        DB::table('permissions')->insert([
            'id' => 45,
            'name' => 'EDIT STOCKIST ',
            'code' => 'ESTOCKIST'
        ]);
        DB::table('permissions')->insert([
            'id' => 46,
            'name' => 'ARCHIVE STOCKIST ',
            'code' => 'ASTOCKIST'
        ]);
        DB::table('permissions')->insert([
            'id' => 47,
            'name' => 'LIST STOCKIST ',
            'code' => 'LSTOCKIST'
        ]);
        DB::table('permissions')->insert([
            'id' => 48,
            'name' => 'GET STOCKIST ',
            'code' => 'GSTOCKIST'
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
