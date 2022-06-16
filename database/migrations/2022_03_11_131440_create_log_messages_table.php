<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('timestamp')->unsigned();
            $table->string('version_code', 20);
            $table->string('version_name', 20);
            $table->string('android', 20);
            $table->macAddress('ether')->nullable();
            $table->macAddress('wifi')->nullable();
            $table->string('serialno', 20)->nullable();
            $table->string('action', 32);
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
        Schema::dropIfExists('log_messages');
    }
}
