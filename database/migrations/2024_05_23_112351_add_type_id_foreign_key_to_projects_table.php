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
        Schema::table('projects', function (Blueprint $table) {
            //creo la colonna type_id
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            //creo il vincolo tra la colonna type_id e l'id della tabella types
            $table->foreign('type_id')
            ->references('id')
            ->on('types')
            ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //droppo prima il vincolo
            $table->dropForeign('projects_type_id_foreign');
            //droppo la colonna
            $table->dropColumn('type_id');
        });
    }
};
