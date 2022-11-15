<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;


    protected $fillable = [
        'title',
        'details',
        'slug',
        'image',
        'user_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        {
            return [
                'slug' => [
                    'source' => ['title', 'id']
                ],
            ];
        }
    }

}
