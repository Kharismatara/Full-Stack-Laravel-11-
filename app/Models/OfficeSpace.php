<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class OfficeSpace extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'city_id',
        'is_open',
        'is_ful_booked',
        'price',
        'duration',
        'address'
    ];

    public function setNameAttribute($value){
        $this->attributes['name']= $value;
        $this->attributes['slug']= Str::slug($value);
    }

    public function photo(): HasMany{
        return $this->hasMany(OfficeSpacePhoto::class);
    }

    public function benefits(): HasMany{
        return $this->hasMany(OfficeSpaceBenefit::class);
    }

    public function city(): BelongsTo{
        return $this->belongsTo(City::class);
    }
}