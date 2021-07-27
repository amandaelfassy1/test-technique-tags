<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Facades\File;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tag::factory()->count(10)->create();

        $json = File::get("database/default_data/tags.json");
        if($json){
            $data = json_decode($json);
            foreach($data as $obj){
                Tag::create(array(
                    'name' => $obj->name
                ));
            }
        }
    }
}
