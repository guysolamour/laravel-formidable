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
        Schema::create('formidable', function (Blueprint $table) {
            $table->id();
            $table->string("url")->nullable();
            $table->string("short_code")->nullable();
            $table->string("title")->nullable();
            $table->boolean("active")->default(true);
            $table->longText("fields")->nullable();
            $table->longText("entries")->nullable();
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
        Schema::dropIfExists('formidable');
    }
};
