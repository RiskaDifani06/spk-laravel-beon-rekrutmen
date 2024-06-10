<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borda extends Model
{
  use HasFactory;

  protected $table = 'borda';

  protected $fillable = [
    'alternatif_id',
    'score',
    'rank',
  ];

  public function alternatif()
  {
    return $this->belongsTo(Alternatif::class);
  }
}
