<?php

namespace App\Models;

use App\Models\VehicleItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicles extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['vehicleItems'];


    public function vehicleItems(): HasMany
    {
        return $this->hasMany(VehicleItems::class, 'vehicle_id', 'id');
    }
}
