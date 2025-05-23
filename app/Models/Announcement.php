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
        'school_level',
        'price',
        'state',
        'exchange_location',
        'exchange_location_lat',
        'exchange_location_logt',
        'user_id',
        'category_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
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
