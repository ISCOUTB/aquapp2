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
        $this->call(UsersTableSeeder::class);
        $this->call(NodeTypesTableSeeder::class);
        $this->call(NodesTableSeeder::class);
        $this->call(SensorDataTableSeeder::class);
    }
}
