<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TemplateFieldTableSeeder::class);
        $this->call(TemplateGroupTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TemplateVideosTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
    }
}
