<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
  use HasFactory;

  protected $table = 'sub_kriteria';
  protected $fillable = ['kriteria_id', 'nama', 'bobot', 'tipe', 'role_id'];

  public function kriteria()
  {
    return $this->belongsTo(Kriteria::class);
  }

  public function values()
  {
    return $this->hasMany(AlternativeValues::class, 'subkriteria_id');
  }

  public function role()
  {
    return $this->belongsTo(Role::class);
  }
}
