<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\Sector;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $note = Note::first();
        if (!$note) {
            $this->command->line("Generating Notes");
            $notes = ['iii','kkk','mmmm','bbbb','oooo'];
            collect($notes)->each(function ($note_description, $key) {
                $note = new Note();
                $note->description = $note_description;
                $note->save();
            });
        }
    }
}
