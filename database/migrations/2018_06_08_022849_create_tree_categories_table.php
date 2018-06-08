<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20)->unique()->comment('树木类型名称');
            $table->string('introduction',500)->comment('简介');
            $table->string('subject',20)->comment('科目');
            $table->string('image_url')->comment('图片');
            $table->unsignedInteger('order')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态0禁用1启用');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tree_categories');
    }
}
