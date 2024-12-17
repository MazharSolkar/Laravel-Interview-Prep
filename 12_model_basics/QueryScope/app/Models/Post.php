<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PostDetail;

class Post extends Model
{
    use HasFactory;

    protected static function booted() {
        static::addGlobalScope(new PostDetail);
    }

    public function scopeActive($query, $value) {
        return $query->where('status',$value);
    }

    public function scopePostDetail($query) {
        return $query->with('user:id,name', 'categories:id,name');
    }

    public function categories() 
    {
        return $this->belongsToMany(Category::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
