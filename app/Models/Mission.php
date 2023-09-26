<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mission extends Model
{
    use HasFactory;
    protected $guarded = [];


    /**
     * Get all of the vehicles for the Mission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicles::class, 'mission_id', 'id');
    }

    /**
     * Get all of the quotation for the Mission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotation(): HasMany
    {
        return $this->hasMany(Quotation::class, 'mission_id', 'id');
    }
}
