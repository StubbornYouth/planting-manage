<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('area_id')->index()->comment('所属区域');
            $table->unsignedInteger('category_id')->index()->comment('所属分类');
            $table->string('sn',20)->unique()->comment('树木编号');
            $table->double('price', 15, 2)->comment('价格');
            $table->double('width', 15, 2)->comment('米经');
            $table->double('height', 15, 2)->comment('高度');
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
        Schema::dropIfExists('Trees');
    }
}
