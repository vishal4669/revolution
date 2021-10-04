<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_fk_4598224')->references('id')->on('events');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id', 'ticket_fk_4685239')->references('id')->on('tickets');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5030140')->references('id')->on('users');
        });
    }
}
