<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarqueesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marquees', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->unsigned();
            $table->bigInteger('project_id')->nullable()->unsigned();
            $table->foreign('project_id')->nullable()->references('id')->on('projects');
            $table->bigInteger('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->nullable()->references('id')->on('products');
            $table->bigInteger('prev_id')->unsigned()->nullable();
            $table->string('name')->unique();
            $table->string('content');
            $table->string('url')->nullable();
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
        Schema::dropIfExists('marquees');
    }
}
