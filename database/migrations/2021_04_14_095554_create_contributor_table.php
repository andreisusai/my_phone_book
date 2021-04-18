<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributors', function (Blueprint $table) {
            $table->id();
            $table->enum('civility', ['male', 'female', 'non_binaire', 'not_specified']);
            $table->string('last_name');
            $table->string('first_name');
            $table->string('street');
            $table->string('zip_code');
            $table->string('city');
            $table->string('phone');
            $table->string('email')->unique();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributor');
    }
}
