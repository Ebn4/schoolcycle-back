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

    public function favorite(){
        return $this->hasOne(Favorite::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }

}
