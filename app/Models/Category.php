<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;

class Category extends Model
{
    use HasFactory, HasProfilePhoto;

    protected $fillable = [
        'name',
        'profile_photo_path'
    ];

    protected $appends=[
      'profile_photo_url'
    ];
}
