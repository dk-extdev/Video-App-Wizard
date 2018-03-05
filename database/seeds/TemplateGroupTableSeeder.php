<?php

use Illuminate\Database\Seeder;

class TemplateGroupTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('template_group')->delete();
        
        \DB::table('template_group')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project' => '0005',
            ),
            1 => 
            array (
                'id' => 2,
                'project' => '0007',
            ),
            2 => 
            array (
                'id' => 3,
                'project' => '0008',
            ),
            3 => 
            array (
                'id' => 4,
                'project' => '0010',
            ),
            4 => 
            array (
                'id' => 5,
                'project' => '0011',
            ),
            5 => 
            array (
                'id' => 6,
                'project' => '0012',
            ),
            6 => 
            array (
                'id' => 7,
                'project' => '0013',
            ),
            7 => 
            array (
                'id' => 8,
                'project' => '0014',
            ),
            8 => 
            array (
                'id' => 9,
                'project' => '0015',
            ),
            9 => 
            array (
                'id' => 10,
                'project' => '0010',
            ),
            10 => 
            array (
                'id' => 11,
                'project' => '0017',
            ),
            11 => 
            array (
                'id' => 12,
                'project' => '0018',
            ),
            12 => 
            array (
                'id' => 13,
                'project' => '0019',
            ),
            13 => 
            array (
                'id' => 14,
                'project' => '0020',
            ),
            14 => 
            array (
                'id' => 15,
                'project' => '0021',
            ),
            15 => 
            array (
                'id' => 16,
                'project' => '0022',
            ),
            16 => 
            array (
                'id' => 17,
                'project' => '0023',
            ),
            17 => 
            array (
                'id' => 18,
                'project' => '0024',
            ),
            18 => 
            array (
                'id' => 19,
                'project' => '0025',
            ),
            19 => 
            array (
                'id' => 20,
                'project' => '0009',
            ),
        ));
        
        
    }
}