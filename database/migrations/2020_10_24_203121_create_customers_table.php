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
            $table->string('company_name', 50);
            $table->string('academic_degree', 50);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('address', 255);
            $table->string('address_addition', 255);
            $table->string('zip', 255);
            $table->string('city', 255);
            $table->string('email', 255);
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
