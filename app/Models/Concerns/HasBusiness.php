<?php

namespace App\Models\Concerns;

use App\Models\Business;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasBusiness
{
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
