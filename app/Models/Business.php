<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model 
{
  use HasFactory,  SoftDeletes;

  public function users(): HasOne
  {
    return $this->hasOne(User::class, 'business_id');
  }

  public function products(): HasMany
  {
    return $this->hasMany(Product::class, 'business_id');
  }


}
