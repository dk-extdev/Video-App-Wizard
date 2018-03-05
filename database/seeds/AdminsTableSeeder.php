<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admins')->delete();
        
        \DB::table('admins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Danil K',
                'email' => 'dk1986830@gmail.com',
                'password' => '$2y$10$GLqc1X/UNWW3kAy42zESuelBWeAIVeLgJRXIdzD/Y6vnnH0auRGGC',
                'phone' => '123456789',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}