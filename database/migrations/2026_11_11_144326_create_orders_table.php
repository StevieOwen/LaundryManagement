<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number');
            $table->timestamp('pickup_date');
            $table->uuid('created_by');
            $table->foreign('created_by')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_phone');
            $table->integer('total_price');
            $table->Enum('payment_status',['paid','unpaid']);
            $table->Enum('processing_status',['Not_washed','Washed','Ironed','Ready_for_pickup','Collected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
