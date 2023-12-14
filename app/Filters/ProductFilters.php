<?php

namespace App\Filters;

use Ambengers\QueryFilter\AbstractQueryFilter;
use App\Filters\Concerns\ByBusiness;
use App\Filters\Concerns\BySoftDeletes;
use App\Filters\products\Categories;
use App\Loaders\ProductLoaders;

class ProductFilters extends AbstractQueryFilter
{
    use ByBusiness, BySoftDeletes;

    protected $loader = ProductLoaders::class;

    protected $searchableColumns = [
        'name',
        'code',
        'description',
    ];

    
}
