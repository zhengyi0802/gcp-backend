<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApkCatagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apk_catagories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->default(0);
            $table->string('name')->unique();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('apk_catagories');
    }
}
