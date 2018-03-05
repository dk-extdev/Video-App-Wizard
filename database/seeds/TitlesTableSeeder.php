<?php

use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('titles')->delete();
        
        \DB::table('titles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Dynamic Video',
                'created_at' => '2017-12-15 13:32:57',
                'updated_at' => '2017-12-15 13:32:57',
            ),
        ));
        
        
    }
}