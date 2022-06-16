<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQACatagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_catagories', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('position')->unsigned()->unique();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('audit')->default(false);
            $table->bigInteger('audit_by')->nullable()->unsigned();
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
        Schema::dropIfExists('q_a_catagories');
    }
}
