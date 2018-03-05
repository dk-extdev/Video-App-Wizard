<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Jhone Doe',
                'email' => 'dk1986830@gmail.com',
                'password' => '$2y$10$BaRtk7Pp7ADcB3zdQS2SbOBxUDarw5g1MVKjMvIdKztjan9B8uqu6',
                'phone' => '123456789',
                'status' => 1,
                'type' => 'Premium',
                'remember_token' => '6oySEIxJIFDt466SbVs5p6gJ67xYUh94VMv6GgimTMCkQFzVRspATcBtDi2Y',
                'created_at' => NULL,
                'updated_at' => '2018-01-31 09:20:13',
            ),
        ));
        
        
    }
}