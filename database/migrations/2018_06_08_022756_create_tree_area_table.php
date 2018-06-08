<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreeAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree_area', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',40)->unique()->comment('区域名称');
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
        Schema::dropIfExists('tree_area');
    }
}
