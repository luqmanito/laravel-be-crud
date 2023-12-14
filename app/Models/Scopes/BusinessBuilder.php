<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BusinessBuilder extends Builder
{

    public function myBusiness()
    {
        return $this->where('business_id', Auth::user()->business_id);
    }

    public function business($business_id)
    {
        return $this->where('business_id', $business_id);
    }
}
