<?php

use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function($table)
        {
            $table->increments('id');
            $table->integer('bundle_id');
            $table->string('name', 128);
            $table->string('method', 32);
            $table->string('link', 64);
            $table->string('host', 64);
            $table->string('content_type', 32);
            $table->text('content');
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
		Schema::drop('requests');
	}

}
