<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

    protected $tables = [
        'users',
        'notes',
        'tags',
        'note_tag'
    ];

    protected $seeders = [
        'UsersSeeder',
        'NotesSeeder'
    ];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run()
    {
        Model::unguard();

        $this->cleanDatabase();

        foreach ($this->seeders as $seedClass) {
            $this->call($seedClass);
        }
    }

    /**
     * Clean out the database for a new seed generation
     */
    private function cleanDatabase()
    {
        if (App::environment() == "testing") {
            DB::statement('PRAGMA foreign_keys = OFF;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }

        if (App::environment() == "testing") {
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }

}
