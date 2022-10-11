<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Storage;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = Storage::disk('local')->get('resources.json');
        $resources = json_decode($path);
        foreach ($resources as $resource)
        {
            \App\Models\Resource::create([
                'name' => $resource->name,
                'resource' => $resource->resource,
                'description' => $resource->description,
                'is_menu' => $resource->is_menu
            ]);
        }
        //$resource = \App\Models\Resource::where('resource' == '');
        \App\Models\Role::create([
            'name' => 'User',
            'position' => 0,
            'deletable' => false
        ]);
    }
}
