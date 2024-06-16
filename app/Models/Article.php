<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'title',
        'user_id'
    ];

    public function user()
{
    return $this->belongsTo(User::class)->select(['id', 'name']);
}
    
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

}
