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
    }
}
