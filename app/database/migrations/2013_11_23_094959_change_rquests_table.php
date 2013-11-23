<?php

use Illuminate\Database\Migrations\Migration;

class ChangeRquestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requests', function($table)
        {
            $table->dropColumn('host');
            $table->dropColumn('link');
            $table->string('url', 64);

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}