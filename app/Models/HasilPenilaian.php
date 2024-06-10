<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPenilaian extends Model
{
  use HasFactory;

  protected $table = 'hasil_penilaian';
  protected $fillable = ['alternatif_id', 'hasil_penilaian', 'rank', 'user_id'];

  public function alternatif()
  {
    return $this->belongsTo(Alternatif::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
