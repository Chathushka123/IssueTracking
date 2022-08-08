<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rule;

class IssueCommonValidator
{
  public static function getCommonRules()
  {
    return [
        'title'=>['required'],
        'body'=>['nullable'],
        'uuid'=>['required'],
        'slug'=>['required'],
    ];
  }
}