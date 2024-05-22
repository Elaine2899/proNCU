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
            $table->dropColumn('end_time');
            $table->renameColumn('user_id','user_sid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        schema::table('events', function (Blueprint $table) {
            $table->date('end_time')->nullable();
            $table->renameColumn('user_id','user_sid');
        });
    }
};
