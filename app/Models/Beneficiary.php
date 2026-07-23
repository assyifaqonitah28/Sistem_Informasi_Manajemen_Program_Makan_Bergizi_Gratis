<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = ['region_id', 'name', 'nik', 'address', 'phone', 'status'];

    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function distributions() {
        return $this->hasMany(Distribution::class);
    }
}
