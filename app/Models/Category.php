<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function subCategory(){
        return $this->hasMany(Subcategory::class);
    }

    public function issue(){
        return $this->belongsToMany(Issue::class);
    }
}
