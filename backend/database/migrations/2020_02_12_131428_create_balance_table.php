<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBalanceTable extends Migration {

	public function up()
	{
		Schema::create('balance', function(Blueprint $table) {
			$table->increments('id');
			$table->string('money')->nullable();
			$table->string('currency')->nullable()->default("dollar");
			$table->string('currency_icon')->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('admin_id')->unsigned()->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('balance');
	}
}
