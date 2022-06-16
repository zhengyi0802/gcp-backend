<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQAListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_id')->unsigned()->nullable();
            $table->foreign('file_id')->nullable()->references('id')->on('upload_files')->onDelete('cascade');
            $table->bigInteger('catagory_id')->unsigned();;
            $table->foreign('catagory_id')->references('id')->on('q_a_catagories')->onDelete('cascade');
            $table->string('question');
            $table->string('type', 30);
            $table->string('answer');
            $table->string('answer_http')->nullable();
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
        Schema::dropIfExists('q_a_lists');
    }
}
