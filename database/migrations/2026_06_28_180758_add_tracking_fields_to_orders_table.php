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
        Schema::table('orders', function (Blueprint $table) {
            // Note: The status enum in the DB is currently: ['received', 'prep', 'delivery', 'finished']
            // We can add a 'confirmed' status if needed, but to avoid enum errors, we can just use the timestamps to infer state,
            // OR change the enum. In Laravel/MySQL changing enum can be tricky, so let's stick to existing enums and just use these timestamps
            // to show the timeline progression.
            $table->timestamp('confirmed_at')->nullable()->after('status');
            $table->timestamp('prep_at')->nullable()->after('confirmed_at');
            $table->timestamp('delivery_at')->nullable()->after('prep_at');
            $table->timestamp('finished_at')->nullable()->after('delivery_at');
            $table->string('delivery_driver')->nullable()->after('finished_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['confirmed_at', 'prep_at', 'delivery_at', 'finished_at', 'delivery_driver']);
        });
    }
};
