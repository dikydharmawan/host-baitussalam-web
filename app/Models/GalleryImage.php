<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'section',
        'image_path',
        'caption',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
