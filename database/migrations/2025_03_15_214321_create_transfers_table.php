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
        Schema::create('transfers', function (Blueprint $table) {
            
            $table->id();
            $table->smallinteger('type');
            $table->date('date');
            $table->smallinteger('repeattype');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('category');
            $table->unsignedBigInteger('account_from');
            $table->unsignedBigInteger('account_to');
            $table->unsignedBigInteger('users_id');

            // Foreign key constraints
            $table->foreign('category')->references('id')->on('transfer_categories')->onDelete('cascade');
            $table->foreign('account_from')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('account_to')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            
            // Additional fields
            $table->string('note')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
