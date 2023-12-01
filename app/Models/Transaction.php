<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function court()
    {
        return $this->belongsTo(Court::class, 'court_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
