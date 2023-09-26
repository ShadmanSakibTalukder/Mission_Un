<?php

namespace App\Models;

use App\Models\QuotationItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected $with = ['quotationItems'];


    public function quotationItems(): HasMany
    {
        return $this->hasMany(QuotationItems::class, 'quote_id', 'id');
    }
    /**
     * Get the mission that owns the Quotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class, 'mission_id', 'id');
    }
}
