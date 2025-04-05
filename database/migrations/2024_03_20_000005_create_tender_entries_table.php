<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.tender_entries', function (Blueprint $table) {
            $table->id();
            $table->string('tender_no')->unique();
            $table->date('tender_date');
            $table->unsignedBigInteger('department_id');
            $table->string('work_description');
            $table->decimal('estimated_cost', 10, 2);
            $table->decimal('security_deposit', 10, 2);
            $table->date('tender_opening_date');
            $table->date('tender_closing_date');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('department_id')
                ->references('id')
                ->on('department_masters')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tender_entries');
    }
}; 