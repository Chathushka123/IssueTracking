<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'category_id'
    ];
}
