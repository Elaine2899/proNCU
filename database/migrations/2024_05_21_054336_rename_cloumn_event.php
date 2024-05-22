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
        //
        schema::table('events', function (Blueprint $table) {
            
            $table->renameColumn('start_time','date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        schema::table('events', function (Blueprint $table) {
            
            $table->renameColumn('start_time','date');
        });
    }
};
