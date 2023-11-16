<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function court()
    {
        return $this->belongsTo(Court::class, 'court_id', 'id');
    }

    public function bookedSchedule()
    {
        return $this->belongsToMany(Schedule::class, 'booked_id', 'id');
    }
}
