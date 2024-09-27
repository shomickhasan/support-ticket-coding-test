<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('support_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_ticket_id');
            $table->text('reply');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('support_ticket_id')->references('id')->on('support_tickets');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->index('support_ticket_id');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_replies');
    }
};
