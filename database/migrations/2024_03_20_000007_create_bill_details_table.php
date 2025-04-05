<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.bill_details', function (Blueprint $table) {
            $table->id();
            $table->string('site_code');
            $table->string('year');
            $table->date('date');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('subcontractor_id')->nullable();
            $table->string('name_of_work');
            $table->string('bank_name');
            $table->string('work_done_by');
            $table->string('agreement_no');
            $table->string('bill_no');
            $table->decimal('work_order_amount', 10, 2);
            $table->string('work_time_limit');
            $table->string('dlp_period');
            $table->decimal('total_bill_amount', 10, 2);
            $table->decimal('deduction_amount', 10, 2);
            $table->decimal('net_bill_amount', 10, 2);
            $table->decimal('security_deposit', 10, 2);
            $table->decimal('insurance', 10, 2);
            $table->decimal('gst', 10, 2);
            $table->decimal('surcharge', 10, 2);
            $table->decimal('cess', 10, 2);
            $table->decimal('tds', 10, 2);
            $table->decimal('royalty', 10, 2);
            $table->decimal('fine', 10, 2);
            $table->decimal('other', 10, 2);
            $table->decimal('bank_charges', 10, 2);
            $table->decimal('stamp_duty', 10, 2);
            $table->decimal('gram_panchayat_deduction', 10, 2);
            $table->decimal('gram_panchayat_emd', 10, 2);
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->foreign('department_id')
                ->references('id')
                ->on('department_masters')
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
        Schema::dropIfExists('bill_details');
    }
}; 