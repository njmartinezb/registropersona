<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Citizen extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'city_id',
        'address',
        'phone',
    ];

    //Adding city relationship
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
