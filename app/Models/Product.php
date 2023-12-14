<?php

namespace App\Models;

use App\Models\Concerns\HasBusiness;
use App\Models\Scopes\BusinessBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use  HasBusiness, HasFactory, SoftDeletes;

  protected $table = 'products';

  protected $auditInclude = [
    'price',
    'code',
    'name',
    'quantity',
    'is_subtract',
  ];

  protected $casts = [
    'is_subtract' => 'boolean',
  ];

  public function newEloquentBuilder($query): BusinessBuilder
  {
    return new BusinessBuilder($query);
  }
}
