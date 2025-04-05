<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tender.party_master', function (Blueprint $table) {
            $table->id('party_id');
            $table->enum('party_type', ['Supplier', 'Labour Contractor']);
            $table->string('party_name', 100);
            $table->text('address');
            $table->string('contact_person', 100);
            $table->string('contact_number', 15);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('party_master');
    }
}; 