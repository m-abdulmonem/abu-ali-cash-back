<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('site_name_ar')->nullable();
			$table->string('site_name_en')->nullable();
			$table->string('logo')->nullable();
			$table->string('icon')->nullable();
			$table->enum('lang', array(''))->nullable();
			$table->string('email')->nullable();
			$table->text('description')->nullable();
			$table->string('keywords')->nullable();
			$table->enum('status', array('open','closed','maintenance'))->nullable()->default("maintenance");
			$table->integer('paginate')->default(10);
			$table->text('maintenance_message')->nullable();
			$table->timestamp('maintenance_start_at')->nullable();
			$table->timestamp('maintenance_end_at')->nullable();
			$table->string('phone')->nullable();
			$table->string('fb')->nullable();
			$table->string('tw')->nullable();
			$table->string('android_app_link')->nullable();
			$table->string('ios_app_link')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
        \Illuminate\Support\Facades\DB::table('settings')->insert([
            'site_name_ar' => config('app.name'),
            'site_name_en' => config('app.name'),
            'email' => config('app.name') .'@example.com',
        ]);
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
