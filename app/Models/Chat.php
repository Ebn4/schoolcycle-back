<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'announcement_id'
    ];

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
