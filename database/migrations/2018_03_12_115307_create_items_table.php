<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->increments('id', 32)->unsigned();
            $table->integer('category_id', 32);
            $table->integer('user_id', 32);
            $table->char('displayname', 191);
            $table->text('description');
            $table->integer('count_review', 32);
            $table->integer('count_view', 32);
            $table->integer('count', 32);
            $table->integer('weight', 32);
            $table->bigInteger('price', 64);
            $table->text('image_item');
            $table->text('promotion_item');
            $table->text('additionalinfo');
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
        Schema::dropIfExists('items');
    }
}
