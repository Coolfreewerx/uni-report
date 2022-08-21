<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Sector;
use App\Models\Note;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line("sector to note");
        $sector = new Sector();
        $sector->name = "สำนักงานมหาวิทยาลัย";
        $sector->save();

        $sector = new Sector();
        $sector->name = "สำนักบริหารการศึกษา";
        $sector->save();

        $sector = new Sector();
        $sector->name = "สำนักส่งเสริมและฝึกอบรม";
        $sector->save();

        $sector = new Sector();
        $sector->name = "สำนักบริการคอมพิวเตอร์";
        $sector->save();

        $sector = new Sector();
        $sector->name = "สำนักหอสมุด";
        $sector->save();

        /*$sector = Sector::first();
        if (!$sector) {
            $this->command->line("Generating Sectors");
            $sectors = ['สำนักงานมหาวิทยาลัย','สำนักบริหารการศึกษา','สำนักส่งเสริมและฝึกอบรม','สำนักบริการคอมพิวเตอร์','สำนักหอสมุด'];
            collect($sectors)->each(function ($sector_name, $key) {
                $sector = new Sector();
                $sector->name = $sector_name;
                $sector->save();
            });
        }*/

        $this->command->line("Generating Sectors for all posts");
        $posts = Post::get();
        $posts->each(function($post, $key) { // link Sectors to posts
//            $n = fake()->numberBetween(1, 5);
            $sector_ids = Sector::inRandomOrder()->limit(1)->get()->pluck(['id'])->all();
            $post->sectors()->sync($sector_ids);
        });
    }
}
