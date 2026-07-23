<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'parent_id'];

    // Relasi Self-Referencing (Parent-Child)
    public function parent() {
        return $this->belongsTo(Region::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Region::class, 'parent_id');
    }

    // Relasi ke Beneficiary
    public function beneficiaries() {
        return $this->hasMany(Beneficiary::class);
    }
}
