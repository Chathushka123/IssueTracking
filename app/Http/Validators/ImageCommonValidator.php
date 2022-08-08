<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rule;

class ImageCommonValidator
{
  public static function getCommonRules()
  {
    return [
        'size'=>['required'],
        'path'=>['required'],
        'name'=>['required'],
        'extention'=>['required'],
        
    ];
  }
}