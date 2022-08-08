<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rule;

class SubcategoryCommonValidator
{
  public static function getCommonRules()
  {
    return [
        'category_id'=>['required','exists:categories,id'],
        'name'=>['required'],
        'description'=>['nullable']
    ];
  }
}