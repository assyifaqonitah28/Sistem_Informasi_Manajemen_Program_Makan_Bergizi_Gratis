<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = ['program_id', 'beneficiary_id', 'distribution_date', 'quantity', 'status', 'notes'];

    protected $casts = [
        'distribution_date' => 'date',
    ];

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function beneficiary() {
        return $this->belongsTo(Beneficiary::class);
    }

    public function report() {
        return $this->hasOne(Report::class);
    }
}
