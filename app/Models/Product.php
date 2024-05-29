<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Jetstream\HasProfilePhoto;

class Product extends Model
{
    use HasFactory, HasProfilePhoto;

    protected $fillable=[
      'category_id',
      'user_id',
      'name',
      'profile_photo_path',
      'amount'
    ];

    protected $appends=[
        'profile_photo_url'
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
