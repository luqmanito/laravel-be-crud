<?php

namespace App\Filters\Concerns;

trait ByBusiness
{
    public function business($value = null)
    {
        return $value
            ? $this->builder->whereIn($this->builder->qualifyColumn('business_id'), explode(',', $value))
            : $this->builder;
    }
}
