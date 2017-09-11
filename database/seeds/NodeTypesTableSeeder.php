<?php

use Illuminate\Database\Seeder;

use App\NodeType;

class NodeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('node_types')->delete();

        $json = File::get("database/data/node_types.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            NodeType::create([
                'name' => $obj->name,
                'separator' => $obj->separator,
                'sensors' => $obj->sensors
            ]);
        }
    }
}
