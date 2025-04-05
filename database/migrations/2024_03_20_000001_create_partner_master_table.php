<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('partner_master', function (Blueprint $table) {
            $table->id('partner_id');
            $table->string('partner_name', 100);
            $table->string('mobile_number', 15);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partner_master');
    }
}; 