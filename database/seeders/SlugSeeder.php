<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mangas = \App\Models\MangaOverView::all();
        foreach($mangas as $manga)
        {
            $manga->slug = str_replace(' ', '-', $manga->name);
            $manga->save();
        }
    }
}