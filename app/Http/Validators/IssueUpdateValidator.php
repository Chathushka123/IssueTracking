<?php

namespace App\Http\Validators;

use App\Http\Validators\IssueCommonValidator;

class IssueUpdateValidator
{
  public static function getUpdateRules()
  {
    return array_merge([], IssueCommonValidator::getCommonRules());
  }
}