<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('company_name');
			$table->string('company_logo')->nullable();
			$table->string('vip_reward')->nullable();
			$table->string('reward')->nullable();
			$table->string('link')->nullable();
			$table->text('exceptions')->nullable();
			$table->text('about_store')->nullable();
			$table->string('coupon_code')->nullable();
			$table->integer('category_id')->nullable();
			$table->integer('file_id')->unsigned()->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}
