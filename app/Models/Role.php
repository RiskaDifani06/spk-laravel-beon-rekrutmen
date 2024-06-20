<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'name',
    'deleted_at',
  ];

  public function sub_kriteria()
  {
    return $this->hasMany(SubKriteria::class);
  }

  public function alternatif()
  {
    return $this->hasMany(Alternatif::class);
  }
}
