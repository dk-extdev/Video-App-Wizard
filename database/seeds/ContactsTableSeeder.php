<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contacts')->delete();
        
        \DB::table('contacts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'number' => '123456',
                'address' => 'Moscow,Russia',
                'email' => 'dk1986830@gmail.com',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}