<?php

use Illuminate\Database\Migrations\Migration;

class UrlAfterBundleId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requests', function($table)
        {

            $table->dropColumn('url');

        });

        if (Schema::hasColumn('requests', 'url') == false)
        {
            Schema::table('requests', function($table)
            {

                $table->string('url', 64)->after('bundle_id');

            });
        }
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