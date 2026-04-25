<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('footer_sections', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('copyright')->default('© 2025 BakeryChrips. All Rights Reserved.');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('footer_sections');
    }
};