<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateNoteTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('note_tag', function($table)
        {
            $table->integer('note_id')->unsigned();
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('note_tag');
	}

}
