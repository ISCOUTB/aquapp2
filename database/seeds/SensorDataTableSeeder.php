<?php

use Illuminate\Database\Seeder;

use App\Node;
use App\NodeType;
use App\SensorData;


class SensorDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sensor_data')->delete();

        $directory = "database/data/nodes-data";

        $files = File::allFiles($directory);

        if($files)
        {
            foreach ($files as $file)
            {
                $fileInfo = pathinfo($file);
                $nodeId = $fileInfo["filename"];

                $node = Node::find($nodeId);

                //Check if node is valid
                if($node) {
                    $nodeType = $node->node_type;
                    $lines = file($fileInfo["dirname"]. '/' . $fileInfo["basename"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                    echo $fileInfo["basename"] . "\n";

                    foreach($nodeType->sensors as $key => $sensor){
                        $data = [];

                        foreach ($lines as $lineNum => $line) {
                            $line = explode($nodeType->separator, $line);
                            $timestamp = $line[0];

                            $obj = array(
                                "timestamp" => $timestamp,
                                "value" => (float) $line[$key+1]
                            );

                            $data[] = $obj;
                        }

                        SensorData::create([
                            'variable' => $sensor["variable"],
                            'node_id' => $node->id,
                            'data' => $data
                        ]);
                    }
                }
                else
                {
                    continue;
                }

            }
        }
    }
}

















