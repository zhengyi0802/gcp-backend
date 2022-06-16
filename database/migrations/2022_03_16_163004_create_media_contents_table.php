<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pfile_id')->unsigned();
            $table->foreign('pfile_id')->references('id')->on('upload_files')->onDelete('cascade');
            $table->bigInteger('cfile_id')->unsigned()->nullable();
            $table->foreign('cfile_id')->nullable()->references('id')->on('upload_files')->onDelete('cascade');
            $table->bigInteger('catagory_id')->unsigned();
            $table->foreign('catagory_id')->references('id')->on('media_catagories');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('preview');
            $table->string('mime_type', 30);
            $table->string('url');
            $table->string('url_http')->nullable();
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
        Schema::dropIfExists('media_contents');
    }
}
