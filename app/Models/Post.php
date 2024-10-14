<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('id');
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function scopeCreatedThisMonth(Builder $query)
    {
        return $query->whereMonth('created_at', date('m'));
    }
}
