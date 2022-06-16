<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaCatagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_catagories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('upload_files');
            $table->bigInteger('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('type', 10);
            $table->string('name');
            $table->json('keywords')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail');
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
        Schema::dropIfExists('media_catagories');
    }
}
