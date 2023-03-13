<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('用户id');
            $table->unsignedBigInteger('category_id')->comment('分类id');
            $table->char('title', 50)->unique()->comment('标题');
            $table->mediumText('content')->comment('内容');
            $table->tinyInteger('status')->default(1)->comment('状态：0 未发布 1 已发布');
            $table->timestamps();

            // 用户id外键
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            // 分类id外键
            $table->foreign('category_id')
            ->references('id')
            ->on('categorys')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
