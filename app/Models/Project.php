<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'class',
        'category_id',
        'title',
        'description',
        'screenshot_1',
        'screenshot_2',
        'screenshot_3',
        'video',
        'project_link',
        'status'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeByClass($query, $class)
    {
        return $query->where('class', strtoupper($class));
    }
}