<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesSeeder extends Seeder
{

    public function run()
    {
        $note = new \Notes\Note;
        $note->message = "Test note";
        $note->user_id = 1;
        $note->save();

        $tag = new \Notes\Tag;
        $tag->name = "Test tag";
        $tag->save();

        $note->tags()->sync([$tag->id]);
    }

}