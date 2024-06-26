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
    Schema::create('sub_kriteria', function (Blueprint $table) {
      $table->id();
      $table->foreignId('kriteria_id')->constrained('kriteria')->cascadeOnDelete();
      $table->string('nama');
      $table->double('bobot');
      $table->enum('tipe', ['benefit', 'cost']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('sub_kriteria');
  }
};
