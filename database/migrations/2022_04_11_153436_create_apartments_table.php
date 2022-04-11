<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('room_numbers');
            $table->tinyInteger('bed_numbers');
            $table->tinyInteger('bathroom_numbers');
            $table->smallInteger('square_meters');
            $table->string('cover');
            $table->smallInteger('price_per_night');
            $table->string('country');
            $table->string('region');
            $table->string('province');
            $table->string('city');
            $table->string('street');
            $table->smallInteger('street_number');
            $table->smallInteger('post_code');
            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 10, 8);
            $table->string('slug')->unique();
            // aggiunto foreign key collegata ad user_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
