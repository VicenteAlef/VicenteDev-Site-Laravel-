<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'summary',
        'content',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Um projeto tem muitas imagens na galeria
    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
