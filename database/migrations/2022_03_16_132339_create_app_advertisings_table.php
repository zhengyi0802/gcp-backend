<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppAdvertisingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_advertisings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->bigInteger('file_id')->unsigned();
            $table->tinyInteger('interval')->unsigned()->default(5);
            $table->string('thumbnail');
            $table->string('link_url')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('audit')->default(false);
            $table->bigInteger('audit_by')->unsigned()->nullable();
            $table->foreign('audit_by')->nullable()->references('id')->on('users');
            $table->datetime('audit_time')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('app_advertisings');
    }
}
