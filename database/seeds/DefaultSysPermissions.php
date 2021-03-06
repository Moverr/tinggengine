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
             'grouping' => 'SPECIAL',
            'name' => 'ALL_FUNCTIONS',
            'code' => 'ALL_FUNCTIONS'
        ]);


        DB::table('permissions')->insert([
            'id' => 2,
            'grouping' => 'SPECIAL',
            'name' => 'FETCH ONLY OWN RECORDS',
            'code' => 'FOOR'
        ]);
        DB::table('permissions')->insert([
            'id' => 3,
            'grouping' => 'SPECIAL',
            'name' => 'FETCH OWN AND CHILDREN RECORDS',
            'code' => 'FOACR'
        ]);


        //categories
        DB::table('permissions')->insert([
            'id' => 4,
            'grouping' => 'CATEGORIES',
            'name' => 'CREATE PRODUCT CATEGORIES',
            'code' => 'CPG'
        ]);
        DB::table('permissions')->insert([
            'id' => 5,
             'grouping' => 'CATEGORIES',
            'name' => 'EDIT PRODUCT CATEGORIES',
            'code' => 'EPG'
        ]);
        DB::table('permissions')->insert([
            'id' => 6,
             'grouping' => 'CATEGORIES',
            'name' => 'ARCHIVE PRODUCT CATEGORIES',
            'code' => 'APG'
        ]);
        DB::table('permissions')->insert([
            'id' => 7,
             'grouping' => 'CATEGORIES',
            'name' => 'LIST PRODUCT CATEGORIES',
            'code' => 'LPG'
        ]);
        DB::table('permissions')->insert([
            'id' => 8,
             'grouping' => 'CATEGORIES',
            'name' => 'GET PRODUCT CATEGORIES',
            'code' => 'GPG'
        ]);




        //products
        DB::table('permissions')->insert([
            'id' => 14,
             'grouping' => 'PRODUCT',
            
            'name' => 'CREATE PRODUCT ',
            'code' => 'CP'
        ]);
        DB::table('permissions')->insert([
            'id' => 15,
             'grouping' => 'PRODUCT',
            
            'name' => 'EDIT PRODUCT ',
            'code' => 'EP'
        ]);
        DB::table('permissions')->insert([
            'id' => 16,
             'grouping' => 'PRODUCT',
            
            'name' => 'ARCHIVE PRODUCT ',
            'code' => 'AP'
        ]);
        DB::table('permissions')->insert([
            'id' => 17,
             'grouping' => 'PRODUCT',
            
            'name' => 'LIST PRODUCT ',
            'code' => 'LP'
        ]);
        DB::table('permissions')->insert([
            'id' => 18,
             'grouping' => 'PRODUCT',
            
            'name' => 'GET PRODUCT ',
            'code' => 'GP'
        ]);

         DB::table('permissions')->insert([
            'id' => 23,
            
              'grouping' => 'STOCKIST',
            'name' => 'GET STOCKIST ',
            'code' => 'GSTST'
        ]);



        //profile
        DB::table('permissions')->insert([
            'id' => 24,
             'grouping' => 'PROFILE',
            'name' => 'CREATE PROFILE',
            'code' => 'CPRL'
        ]);
        DB::table('permissions')->insert([
            'id' => 25,
             'grouping' => 'PROFILE',
            'name' => 'EDIT PROFILE ',
            'code' => 'EPRL'
        ]);
        DB::table('permissions')->insert([
            'id' => 26,
             'grouping' => 'PROFILE',
            'name' => 'ARCHIVE PROFILE ',
            'code' => 'APRL'
        ]);
        DB::table('permissions')->insert([
            'id' => 27,
             'grouping' => 'PROFILE',
            'name' => 'LIST PROFILE ',
            'code' => 'LPRL'
        ]);
        DB::table('permissions')->insert([
            'id' => 28,
             'grouping' => 'PROFILE',
            'name' => 'GET PROFILE ',
            'code' => 'GPRL'
        ]);





        //purchase
        DB::table('permissions')->insert([
            'id' => 29,
             'grouping' => 'PURCHASE',
            'name' => 'CREATE PURCHASE',
            'code' => 'CPUR'
        ]);
        DB::table('permissions')->insert([
            'id' => 30,
            'grouping' => 'PURCHASE',
            'name' => 'EDIT PURCHASE ',
            'code' => 'EPUR'
        ]);
        DB::table('permissions')->insert([
            'id' => 31,
            'grouping' => 'PURCHASE',
            'name' => 'ARCHIVE PURCHASE ',
            'code' => 'APUR'
        ]);
        DB::table('permissions')->insert([
            'id' => 32,
            'grouping' => 'PURCHASE',
            'name' => 'LIST PURCHASE ',
            'code' => 'LPUR'
        ]);
        DB::table('permissions')->insert([
            'id' => 33,
            'grouping' => 'PURCHASE',
            'name' => 'GET PURCHASE ',
            'code' => 'GPUR'
        ]);




        //stockist
        DB::table('permissions')->insert([
            'id' => 34,
            'grouping' => 'ROLE',
            
            'name' => 'CREATE ROLE',
            'code' => 'CROLE'
        ]);
        DB::table('permissions')->insert([
            'id' => 35,
            'grouping' => 'ROLE',
            
            'name' => 'EDIT ROLE ',
            'code' => 'EROLE'
        ]);
        DB::table('permissions')->insert([
            'id' => 36,
            'grouping' => 'ROLE',
            
            'name' => 'ARCHIVE ROLE ',
            'code' => 'AROLE'
        ]);
        DB::table('permissions')->insert([
            'id' => 37,
            'grouping' => 'ROLE',
            
            'name' => 'LIST ROLE ',
            'code' => 'LROLE'
        ]);
        DB::table('permissions')->insert([
            'id' => 38,
            'grouping' => 'ROLE',
            
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


        
        //TODO: DEALER ROLES MANAGEMENT
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'DEALER',
            'code' => 'DEALER',
            'description' => 'DEALER',
            'status' => 'ACTIVE',
            'is_system' => 1
        ]);

        DB::table('rolepermission')->insert([
            'role_id' => 2,
            'permission_id' => 1
        ]);

        
        DB::table('rolepermission')->insert([
            'role_id' => 2,
            'permission_id' => 2
        ]);


        
        DB::table('rolepermission')->insert([
            'role_id' => 2,
            'permission_id' => 3
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
        
        
        

        DB::table('users')->insert([
            'id' => 2,
            'username' => 'mover',
            'password' => sha1('miles'),
            'status' => 'ACTIVE',
            'group' => 'ADMINISTRATOR'
        ]);


        DB::table('userrole')->insert([
            'user_id' => 2,
            'role_id' => 1
        ]);
        
        
    }

}
