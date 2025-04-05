<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.bill_adjustments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('voucher_no')->unique();
            $table->unsignedBigInteger('bill_detail_id');
            $table->decimal('adjustment_amount', 10, 2);
            $table->enum('adjustment_type', ['Addition', 'Deduction']);
            $table->text('reason');
            $table->timestamps();

            $table->foreign('bill_detail_id')
                ->references('id')
                ->on('bill_details')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bill_adjustments');
    }
}; 