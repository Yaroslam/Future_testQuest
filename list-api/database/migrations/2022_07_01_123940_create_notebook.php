<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notebook', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("FCs");
            $table->string("mob_phone");
            $table->datetime("birthdate")->nullable();
            $table->string("email");
            $table->foreignId("company_id")->references('id')->on('companies');
            $table->string("photo_path")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notebook');
    }
};
