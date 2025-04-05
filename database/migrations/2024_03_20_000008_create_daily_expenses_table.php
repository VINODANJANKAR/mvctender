<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.daily_expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('voucher_no')->unique();
            $table->unsignedBigInteger('account_head_id');
            $table->unsignedBigInteger('party_id');
            $table->text('description');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_mode', ['Cash', 'Bank', 'UPI', 'Card', 'Other']);
            $table->string('reference_no')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->foreign('account_head_id')
                ->references('id')
                ->on('account_head_masters')
                ->onDelete('restrict');

            $table->foreign('party_id')
                ->references('id')
                ->on('party_masters')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_expenses');
    }
}; 