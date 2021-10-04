<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_mode');
            $table->longText('description')->nullable();
            $table->decimal('amount_received', 15, 2)->nullable();
            $table->string('transaction');
            $table->string('unique_reg_no')->unique();
            $table->timestamps();
        });
    }
}
