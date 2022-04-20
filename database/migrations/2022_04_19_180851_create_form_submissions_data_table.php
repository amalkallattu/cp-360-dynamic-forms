<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submissions_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('form_submission_id')->unsigned();
            $table->foreign('form_submission_id')->references('id')->on('form_submissions');
            $table->bigInteger('form_element_id')->unsigned();
            $table->foreign('form_element_id')->references('id')->on('form_elements');
            $table->text('data');
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
        Schema::dropIfExists('form_sumbissions_data');
    }
}
