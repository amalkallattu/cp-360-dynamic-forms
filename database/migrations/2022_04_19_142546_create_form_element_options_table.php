<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormElementOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_element_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('form_element_id')->unsigned();
            $table->foreign('form_element_id')->references('id')->on('form_elements');
            $table->string('option', 20);
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
        Schema::dropIfExists('form_element_options');
    }
}
