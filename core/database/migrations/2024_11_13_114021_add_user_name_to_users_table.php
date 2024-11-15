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
        Schema::table('users', function (Blueprint $table) {
            $table->string('userName')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('front_id_image')->nullable();
            $table->string('back_id_image')->nullable();
            $table->string('address_confirmation_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('userName');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('id_image');
            $table->dropColumn('address_confirmation_image');
        });
    }
};
