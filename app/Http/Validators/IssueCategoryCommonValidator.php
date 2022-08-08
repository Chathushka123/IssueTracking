<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rule;

class IssueCategoryCommonValidator
{
  public static function getCommonRules()
  {
    return [
        'issue_id'=>['required','exists:issues,id'],
        'category_id'=>['required','exists:categories,id']
    ];
  }
}