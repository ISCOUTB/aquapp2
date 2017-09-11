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

        $nodeType = NodeType::where('name', 'Hydro-Meteorologic Factors (HMF)')->first();


        foreach ($data as $obj) {
            Node::create([
                'name' => $obj->name,
                'location' => $obj->location,
                'coordinates' => $obj->coordinates,
                'status' => $obj->status,
                'node_type_id' => $nodeType->id
            ]);
        }
    }
}
