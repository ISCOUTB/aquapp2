<?php

use Illuminate\Database\Seeder;
use App\Node;
use App\NodeType;

class NodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nodes')->delete();

        $json = File::get("database/data/nodes.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            Node::create([
                '_id' => $obj->_id,
                'name' => $obj->name,
                'location' => $obj->location,
                'coordinates' => $obj->coordinates,
                'status' => $obj->status,
                'node_type_id' => $obj->node_type_id
            ]);
        }
    }
}
