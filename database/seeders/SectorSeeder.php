<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sector = Sector::first();
        if (!$sector) {
            $this->command->line("Generating Sectors");
            $sectors = ['สำนักงานมหาวิทยาลัย','สำนักบริหารการศึกษา','สำนักส่งเสริมและฝึกอบรม','สำนักบริการคอมพิวเตอร์','สำนักหอสมุด'];
            collect($sectors)->each(function ($sector_name, $key) {
                $sector = new Sector();
                $sector->name = $sector_name;
                $sector->save();
            });
        }

        $this->command->line("Generating Sectors for all posts");
        $posts = Post::get();
        $posts->each(function($post, $key) { // link Sectors to posts
//            $n = fake()->numberBetween(1, 5);
            $sector_ids = Sector::inRandomOrder()->limit(1)->get()->pluck(['id'])->all();
            $post->sectors()->sync($sector_ids);
        });
    }
}
