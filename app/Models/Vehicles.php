<?php

namespace App\Models;

use App\Models\VehicleItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicles extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['vehicleItems'];


    public function vehicleItems(): HasMany
    {
        return $this->hasMany(VehicleItems::class, 'vehicle_id', 'id');
    }


    /**
     * Get all of the mission for the Vehicles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class, 'mission_id', 'id');
    }
}
