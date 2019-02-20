<?php

use Illuminate\Database\Seeder;

class DefaultSysPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('permissions')->insert([
//            'id' => 1,
//            'name' => 'ALL_FUNCTIONS',
//            'code' => 'ALL_FUNCTIONS'
//        ]);
        
            DB::table('productcategories')->insert([
             
            'name' => 'CATEGORIES',
            'code' => 'CAT',
            'status'=>'ACTIVE',
            'created_by'=>1
        ]);
    
            
    
    }
}
