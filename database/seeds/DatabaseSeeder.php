<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(DefaultSysPermissions::class);
//        $this->call(defaultRole::class);
//        $this->call(defaultUser::class);
    }

}
