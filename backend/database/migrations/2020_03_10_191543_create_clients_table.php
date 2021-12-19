<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->nullable()->unique();
            $table->string('picture')->nullable();
            $table->enum('status', array('active', 'pending', 'blocked'))->default("active")->nullable();
            $table->enum('account_type', array('basic', 'vip'))->default("basic");
            $table->integer('rest_code')->nullable();
            $table->string('api_token')->nullable();
            $table->enum('lang', array('ar', 'en'))->nullable()->default("en");
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('clients');
    }
}
