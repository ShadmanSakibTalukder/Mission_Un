<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddToVehicleList extends Model
{
    use HasFactory;
    protected $guarded = [];


    /**
     * Get the missions that owns the AddToVehicleList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function missions(): BelongsTo
    {
        return $this->belongsTo(Mission::class, 'mission_id', 'id');
    }
}
