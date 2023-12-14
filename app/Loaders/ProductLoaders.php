<?php

namespace App\Loaders;

use Ambengers\QueryFilter\AbstractQueryLoader;

class ProductLoaders extends AbstractQueryLoader
{
    protected $loadables = [
        'business',
    ];
}
