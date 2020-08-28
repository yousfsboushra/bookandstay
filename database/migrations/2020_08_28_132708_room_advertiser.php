<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RoomAdvertiser extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('room_advertiser', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('room_id');
            $table->uuid('advertiser_id');
            $table->float('net_price', 8, 2);
            $table->float('total_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('room_advertiser');
    }
}
