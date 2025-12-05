<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadsTable extends Migration
{
    public function up()
    {
        Schema::create('roads', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->enum('status', ['open', 'closed', 'maintenance'])->default('open');
            $table->json('geometry'); // GeoJSON LineString
            $table->json('properties')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roads');
    }
}
