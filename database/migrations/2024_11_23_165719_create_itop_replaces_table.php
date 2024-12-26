<?php

use App\Models\DdHouse;
use App\Models\Retailer;
use App\Models\Rso;
use App\Models\User;
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
        Schema::create('itop_replaces', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DdHouse::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(User::class, 'zm');
            $table->foreignIdFor(User::class, 'manager');
            $table->foreignIdFor(User::class, 'supervisor');
            $table->foreignIdFor(Rso::class);
            $table->foreignIdFor(Retailer::class);
            $table->string('number');
            $table->string('sim_serial');
            $table->string('balance');
            $table->string('reason');
            $table->string('status')->default('pending');
            $table->string('remarks')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('requested_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itop_replaces');
    }
};
