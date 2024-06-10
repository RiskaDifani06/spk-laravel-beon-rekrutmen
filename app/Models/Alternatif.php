<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
  use HasFactory;

  protected $table = 'alternatif';
  protected $fillable = ['nama', 'role_id'];

  public function role()
  {
    return $this->belongsTo(Role::class, 'role_id');
  }

  public function values()
  {
    return $this->hasMany(AlternativeValues::class, 'alternatif_id');
  }

  public function hasilPenilaian()
  {
    return $this->hasOne(HasilPenilaian::class, 'alternatif_id');
  }

  public function borda()
  {
    return $this->hasOne(Borda::class, 'alternatif_id');
  }
}
