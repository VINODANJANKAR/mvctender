<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.account_head_master', function (Blueprint $table) {
            $table->id('ac_head_id');
            $table->string('ac_head_name', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('account_head_master');
    }
}; 