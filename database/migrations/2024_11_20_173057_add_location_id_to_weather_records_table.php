<?php

use App\Models\Location;
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
        Schema::table('weather_records', function (Blueprint $table) {
            $table->foreignIdFor(Location::class)->nullable()->constrained()->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weather_records', function (Blueprint $table) {
            $table->dropForeignIdFor(Location::class);
            $table->dropColumn('location_id');
        });
    }
};
