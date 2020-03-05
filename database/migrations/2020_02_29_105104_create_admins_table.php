<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('uuid')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('encryption_key')->nullable()->default(null);
            $table->char('is_live',1);
            $table->string('password');
            $table->string('api_token', 80)->unique()->nullable()->default(null);;
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
        Schema::dropIfExists('admins');
    }
}
