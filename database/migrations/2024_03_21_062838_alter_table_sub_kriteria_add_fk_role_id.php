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
    Schema::table('sub_kriteria', function (Blueprint $table) {
      $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete()->after('kriteria_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('sub_kriteria', function (Blueprint $table) {
      $table->dropForeign(['role_id']);
      $table->dropColumn('role_id');
    });
  }
};
