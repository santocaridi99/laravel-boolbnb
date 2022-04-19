<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteMultipleColumnFromApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn('street');
            $table->dropColumn('city');
            $table->dropColumn('street_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->string('street_number');
            $table->string('city');
            $table->string('street');
        });
    }
}
