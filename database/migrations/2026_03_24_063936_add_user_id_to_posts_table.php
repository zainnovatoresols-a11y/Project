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
        Schema::table('post', function (Blueprint $table) {
            // Add the user_id column
            $table->foreignId('user_id')
                ->nullable()
                ->foreignId('user_id')->constrained()
                ->cascadeOnDelete()
                ->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post', function (Blueprint $table) {
            // Drop the foreign key and the column in the down method
            $table->dropConstrainedForeignId('user_id'); // Shorthand for dropping foreign key
            // Or use specific drop commands:
            // $table->dropForeign(['user_id']); 
            // $table->dropColumn('user_id');
        });
    }
};
