<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeAndCategoryMilestonesTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('milestones', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade')->after('icon_image');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')
                ->on('types')
                ->onDelete('cascade')
                ->onUpdate('cascade')->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('milestones', function (Blueprint $table) {
            //
        });
    }
}
