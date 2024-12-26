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
        Schema::create('dd_houses', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('cluster')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('proprietor_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('poc_name')->nullable();
            $table->string('poc_number')->nullable();
            $table->string('lifting_date')->nullable();
            $table->boolean('status')->default(false);
            $table->string('remarks')->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_houses');
    }
};
