<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startpages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('upload_files')->onDelete('cascade');
            $table->bigInteger('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->nullable()->references('id')->on('projects');
            $table->string('name')->unique();
            $table->string('mime_type', 20);
            $table->string('url');
            $table->string('url_http')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('intervals')->unsigned()->default(15);
            $table->datetime('start_time')->nullable();
            $table->datetime('stop_time')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('startpages');
    }
}
