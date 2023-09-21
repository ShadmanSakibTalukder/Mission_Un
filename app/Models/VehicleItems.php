<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleItems extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the quotation that owns the QuotationItems
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicles(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id', 'id');
    }
}
