<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.department_master', function (Blueprint $table) {
            $table->id('department_id');
            $table->string('department_name', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('department_master');
    }
}; 