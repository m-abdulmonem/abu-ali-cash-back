<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferUsersTable extends Migration {

	public function up()
	{
		Schema::create('offer_users', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('offer_id')->unsigned()->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('offer_users');
	}
}