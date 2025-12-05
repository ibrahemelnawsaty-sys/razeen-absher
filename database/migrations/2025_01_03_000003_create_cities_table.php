<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->json('geometry'); // GeoJSON Polygon
            $table->decimal('center_lat', 10, 7);
            $table->decimal('center_lng', 10, 7);
            $table->integer('population')->nullable();
            $table->json('stats')->nullable(); // إحصائيات المدينة
            $table->timestamps();
            
            $table->index(['center_lat', 'center_lng']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
