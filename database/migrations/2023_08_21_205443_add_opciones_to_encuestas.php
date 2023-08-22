<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*protected $opciones = [
        'opciones' => ['#4b77a9', '#5f255f', '#5cd55f', '#5ab55f']
    ];*/
    public function up(): void
    {
        Schema::table('encuestas', function (Blueprint $table) {
            $table->longText('opciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encuestas', function (Blueprint $table) {
            $table->dropColumn('opciones');
        });
    }
};
