<?php

use App\Models\Aircraft;
use App\Models\Airline;
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
        $this->down();
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Airline::class)->references('id')->on('airlines');
            $table->foreignIdFor(Aircraft::class)->references('id')->on('aircraft');
            $table->string('source');
            $table->string('destination');
            $table->string('take_off', 5);
            $table->boolean('is_cancelled');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
