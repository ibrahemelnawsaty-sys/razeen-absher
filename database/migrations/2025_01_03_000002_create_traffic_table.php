<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficTable extends Migration
{
    public function up()
    {
        Schema::create('traffic', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('road_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('congestion', ['low', 'medium', 'high'])->default('low');
            $table->enum('severity', ['info', 'warning', 'danger'])->default('info');
            $table->json('geometry'); // GeoJSON Point
            $table->timestamp('detected_at')->useCurrent();
            $table->timestamps();
            
            $table->index(['congestion', 'detected_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('traffic');
    }
}
