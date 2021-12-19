<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('picture')->nullable();
            $table->enum('status', array('active', 'blocked'))->nullable()->default("active");
            $table->integer('reset_code')->nullable();
            $table->string('token')->nullable();
            $table->enum('account_type', array('basic', 'vip'))->nullable()->default("basic");
            $table->enum('lang', array('ar', 'en'))->nullable()->default("en");
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        $admin = DB::table('users')->insert([
            'name' => config('app.name') . ' Admin',
            'username' => 'admin',
            'email' => config('app.name') . '@example.com',
            'reset_code' => rand(1000,9000),
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'token' => \Illuminate\Support\Str::random(60)
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
