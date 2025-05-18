<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    /** @use HasFactory<\Database\Factories\AnnouncementFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'operation_type',
        'is_completed',
        'is_canceled',
        'exchange_location',
        'exchange_location_lat',
        'exchange_location_logt'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }
}
