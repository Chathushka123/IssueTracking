<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rule;

class IssueSubcategoryCommonValidator
{
  public static function getCommonRules()
  {
    return [
        'issue_id'=>['required','exists:issues,id'],
        'subcategory_id'=>['required','exists:subcategories,id']
    ];
  }
}