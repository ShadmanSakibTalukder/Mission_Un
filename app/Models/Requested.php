<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requested extends Model
{
    use HasFactory;

    protected $table = 'requested';

    protected $fillable = [

        'requested_id',
        'part_no',
        'nomenclature',
        'qty'
    ];
}
