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
            //adds a new role-column to the users table
            //this column will be used to determine the role of the user
            //the default value is set to 'subscriber'
            $table->string('role')->default('subscriber')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //takes the column out if we ever need to roll back
            $table->dropColumn('role');
        });
    }
};
