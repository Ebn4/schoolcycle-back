<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'announcement_id'
    ];

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }
}
