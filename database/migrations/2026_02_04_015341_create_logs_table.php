<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');       // e.g., login, logout, create
            $table->string('module');       // e.g., Users, Products
            $table->text('details')->nullable(); // optional details
            $table->timestamps();           // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
