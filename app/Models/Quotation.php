<?php

namespace App\Models;

use App\Models\QuotationItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected $with = ['quotationItems'];


    public function quotationItems(): HasMany
    {
        return $this->hasMany(QuotationItems::class, 'quote_no', 'id');
    }
}
