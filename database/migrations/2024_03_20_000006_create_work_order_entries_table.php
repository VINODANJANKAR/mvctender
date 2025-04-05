<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.work_order_entries', function (Blueprint $table) {
            $table->id();
            $table->string('sr_no')->unique();
            $table->date('entry_date');
            $table->string('entry_year');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('tender_id');
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('subcontractor_id')->nullable();
            $table->string('work_done_by');
            $table->string('agreement_no');
            $table->string('work_order_no');
            $table->date('work_order_date');
            $table->decimal('work_order_amount', 10, 2);
            $table->string('work_time_limit');
            $table->string('dlp_period');
            $table->decimal('security_deposit', 10, 2);
            $table->decimal('additional_security_deposit', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('department_id')
                ->references('id')
                ->on('department_masters')
                ->onDelete('restrict');

            $table->foreign('tender_id')
                ->references('id')
                ->on('tender_entries')
                ->onDelete('restrict');

            $table->foreign('contractor_id')
                ->references('id')
                ->on('party_masters')
                ->onDelete('restrict');

            $table->foreign('subcontractor_id')
                ->references('id')
                ->on('party_masters')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_order_entries');
    }
}; 