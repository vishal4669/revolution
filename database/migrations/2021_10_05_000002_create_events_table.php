<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->date('last_booking_date');
            $table->date('event_start_day')->nullable();
            $table->longText('terms')->nullable();
            $table->string('location')->nullable();
            $table->string('event_type');
            $table->time('reporting_time');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('is_active')->nullable();
            $table->string('is_cancelled')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
