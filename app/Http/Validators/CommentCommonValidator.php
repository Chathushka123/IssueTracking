<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rule;

class CommentCommonValidator
{
  public static function getCommonRules()
  {
    return [
        'body'=>['required']
    ];
  }
}