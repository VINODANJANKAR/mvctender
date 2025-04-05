<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.payment_entries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('voucher_no')->unique();
            $table->unsignedBigInteger('party_id');
            $table->enum('payment_type', ['Received', 'Given']);
            $table->decimal('amount', 10, 2);
            $table->enum('payment_mode', ['Cash', 'Bank', 'UPI', 'Card', 'Other']);
            $table->string('reference_no')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('party_id')
                ->references('id')
                ->on('party_masters')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_entries');
    }
}; 