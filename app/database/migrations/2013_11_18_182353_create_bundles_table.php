<?php

use Illuminate\Database\Migrations\Migration;

class CreateBundlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bundles', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name', 64);
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bundles');
	}

}
