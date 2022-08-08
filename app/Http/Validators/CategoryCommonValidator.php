<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rule;

class CategoryCommonValidator
{
  public static function getCommonRules()
  {
    return [
        'name'=>['required'],
        'description'=>['nullable']
    ];
  }
}