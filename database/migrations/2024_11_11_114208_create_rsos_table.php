<?php

use App\Models\DdHouse;
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
        Schema::create('rsos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DdHouse::class);
            $table->foreignIdFor(User::class, '');
            $table->foreignIdFor(User::class, 'zm');
            $table->foreignIdFor(User::class, 'manager');
            $table->foreignIdFor(User::class, 'supervisor');
            $table->string('osrm_code')->nullable();
            $table->string('employee_code')->nullable();
            $table->string('code')->nullable();
            $table->string('number');
            $table->string('pool_number')->nullable();
            $table->string('personal_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('religion')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('brunch_name')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('education')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('gender')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('market_type')->nullable();
            $table->string('salary')->nullable();
            $table->string('category')->nullable();
            $table->string('agency_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('nid')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('sr_no')->nullable();
            $table->string('designation')->nullable();
            $table->timestamp('joining_date')->nullable();
            $table->timestamp('resign_date')->nullable();
            $table->boolean('status')->default(false);
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsos');
    }
};
