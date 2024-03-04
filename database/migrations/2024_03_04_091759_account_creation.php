<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('tier')->unsigned();
            $table->enum('type', ['savings', 'current']);
            $table->string('currency')->default('NGN');
            $table->boolean('can_credit')->default(true);
            $table->boolean('can_debit')->default(true);
            $table->decimal('balance', 10)->default(0);
            $table->boolean('status')->default(true);
            $table->string('additional_field')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
