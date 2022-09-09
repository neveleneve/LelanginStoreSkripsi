<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_bids', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('id_item');
            $table->string('number', 16);
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_status', ['1', '2', '3', '4', '5'])->comment('1=notrx on midtrans but exist code, 2=pending, 3=expire, 4=settlemet, 5=cancel');
            $table->string('snap_token', 36)->nullable();
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
        Schema::dropIfExists('join_bids');
    }
}
