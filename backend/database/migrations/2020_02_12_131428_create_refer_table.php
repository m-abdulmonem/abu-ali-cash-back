<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReferTable extends Migration {

	public function up()
	{
		Schema::create('refer', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('parent')->unsigned()->nullable();
			$table->integer('child')->unsigned()->nullable();
			$table->enum('account_type', array('basic', 'vip'))->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('refer');
	}
}
