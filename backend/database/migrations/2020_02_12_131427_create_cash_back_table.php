<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCashBackTable extends Migration {

	public function up()
	{
		Schema::create('cash_back', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('vip_reward')->nullable();
			$table->string('reward');
			$table->integer('offer_id')->unsigned();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cash_back');
	}
}