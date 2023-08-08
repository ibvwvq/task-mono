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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->text('textFeedback')->nullable();
            $table->integer('countMarkFeedback')->nullable();
            $table->unsignedBigInteger('rating_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();

            $table->index('rating_id','feedback_rating_idx');
            $table->foreign('rating_id','feedback_rating_fk')
                ->on('ratings')
                ->references('id')
                ->onDelete('cascade');


            $table->index('user_id','feedback_user_idx');
            $table->foreign('user_id','feedback_user_fk')
                ->on('users')
                ->references('id')
                ->onDelete('cascade');

            $table->index('product_id','feedback_product_idx');
            $table->foreign('product_id','feedback_product_fk')
                ->on('products')
                ->references('id')
                ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
