<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVipCardsTable extends Migration {

	public function up()
	{
		Schema::create('vip_cards', function(Blueprint $table) {
			$table->increments('id');
			$table->string('coupon_code')->nullable();
			$table->string('price')->nullable();
			$table->enum('status', array('active', 'disactive'))->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('vip_cards');
	}
}