<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'image_path'];

    // Uma imagem pertence a um projeto
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
