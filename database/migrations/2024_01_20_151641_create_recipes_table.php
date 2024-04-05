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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('spice')->nullable();
            $table->string('c_time')->nullable();
            $table->enum('eating_order', ['starter', 'main', 'dessert', 'baking']);
            $table->text('comment')->nullable();
            $table->string('printed_source')->nullable();
            $table->text('whole_text')->nullable();
            $table->string('url')->nullable();
            $table->boolean('cooked')->default(false);
            $table->unsignedInteger('rating')->default(0);
            $table->text('judgement')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
