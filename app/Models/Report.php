<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['distribution_id', 'user_id', 'report_date', 'description', 'image', 'status'];

    protected $casts = [
        'report_date' => 'date',
    ];

    public function distribution() {
        return $this->belongsTo(Distribution::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
