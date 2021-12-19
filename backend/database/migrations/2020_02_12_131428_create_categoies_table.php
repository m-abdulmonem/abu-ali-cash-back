<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoiesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('name_ar')->nullable();
			$table->text('details')->nullable();
			$table->integer('subchild')->nullable();
			$table->string('link')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('categoies');
	}
}
