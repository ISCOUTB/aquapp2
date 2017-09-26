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

        /*
         * Hydro-Meteorologic Factors
         */
        $directory = "database/data/nodes-data/HMF";

        $files = File::allFiles($directory);

        if($files) {
            foreach ($files as $file) {
                $fileInfo = pathinfo($file);
                $split = explode('-', $fileInfo["filename"]); //59b75c5f9a8920223f2eabe7-Water Temperature
                $nodeId = $split[0];
                $variableName = $split[1];

                //Check if node and variable are valid
                $node = Node::find($nodeId);
                $variable = NodeType::where('sensors.variable', $variableName)->first();

                if($node and $variable) {
                    $lines = file($fileInfo["dirname"]. '/' . $fileInfo["basename"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                    echo $fileInfo["basename"] . "\n";

                    $data = [];
                    foreach ($lines as $lineNum => $line) {
                        $line = explode(',', $line); // explode by separator
                        $timestamp = $line[0]; // 11/28/16 08:50:00 PM
                        $timestamp = date("YmdHis", strtotime($timestamp));

                        $obj = array(
                            "timestamp" => $timestamp,
                            "value" => (float) $line[1]
                        );

                        $data[] = $obj;
                    }

                    SensorData::create([
                        'variable' => $variableName,
                        'node_id' => $node->id,
                        'data' => $data
                    ]);

                }
                else
                {
                    continue;
                }

            }
        }

    }
}
