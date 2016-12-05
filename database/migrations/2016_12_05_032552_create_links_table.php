<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Blueprint $table   表结构构建器
        Schema::create('links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id')->notNull()->unsigned()->comment('id');
            $table->string('name',50)->notNull()->comment('链接名字');
            $table->string('title',50)->nullable()->default(null)->comment('说明');
            $table->string('url')->nullable()->default(null)->comment('链接');
            $table->integer('order')->nullable()->default(0)->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('links');
    }
}
