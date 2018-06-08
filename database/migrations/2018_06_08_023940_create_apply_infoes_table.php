<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyInfoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_infoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tree_id')->index()->comment('树木id');
            $table->string('name')->comment('姓名');
            $table->string('team_name')->comment('团体名称');
            $table->string('contact_name')->comment('联系人');
            $table->string('phone')->comment('联系电话');
            $table->string('email')->comment('联系邮箱');
            $table->unsignedTinyInteger('read')->default(0)->comment('已读状态0未读1已读');
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
        Schema::dropIfExists('apply_infoes');
    }
}
