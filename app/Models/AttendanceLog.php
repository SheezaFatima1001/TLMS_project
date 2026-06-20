<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    use HasFactory;

    // Allow these fields to be mass-assigned
    protected $fillable = [
        'user_id',
        'date',
        'clock_in',
        'clock_out',
        'hours_worked',
        'status',
    ];

    // Define relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}