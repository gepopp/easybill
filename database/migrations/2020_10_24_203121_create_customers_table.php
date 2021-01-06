<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('company_name', 255)->nullable();
            $table->string('academic_degree', 255)->nullable();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('address', 255);
            $table->string('address_addition', 255)->nullable();
            $table->string('zip', 255);
            $table->string('city', 255);
            $table->string('email', 255);
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
