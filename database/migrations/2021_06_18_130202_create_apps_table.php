<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title' , 600);
            $table->string('shortcut', 700);
            $table->string('title_image', 300);
            $table->string('forchildren', 300)->default('لا');
            $table->boolean('monitoring')->default(0);
            $table->text('description');
            $table->json('category');
            $table->json('countries');
            $table->bigInteger('visual_id');
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
        Schema::dropIfExists('apps');
    }
}
