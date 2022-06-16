<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApkProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apk_programs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('upload_files');
            $table->bigInteger('catagory_id')->unsigned();
            $table->foreign('catagory_id')->references('id')->on('apk_catagories');
            $table->tinyInteger('launcher_id')->unsigned()->default(0);
            $table->json('keywords')->nullable();
            $table->string('label');
            $table->string('package_name');
            $table->string('package_version_name')->nullable();
            $table->string('package_version_code')->nullable();
            $table->string('sdk_version')->nullable();
            $table->string('icon');
            $table->string('path');
            $table->text('description')->nullable();
            $table->boolean('local')->default(false);
            $table->boolean('status')->default(true);
            $table->json('type_id')->nullable();
            $table->json('project_id')->nullable();
            $table->json('mac_addresses')->nullable();
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
        Schema::dropIfExists('apk_programs');
    }
}
