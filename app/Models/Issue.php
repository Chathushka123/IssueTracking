<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'uuid',
        'slug'
    ];

    protected $primarykay = 'uuid';

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function subcategory(){
        return $this->belongsToMany(Subcategory::class);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    
}
