<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('cake_image')->default('cake1.png');
            $table->string('strawberry_left')->default('s1.png');
            $table->string('strawberry_right')->default('s2.png');
            $table->string('button_text')->default('Lihat Produk');
            $table->string('button_link')->default('#terlaris');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hero_sections');
    }
};