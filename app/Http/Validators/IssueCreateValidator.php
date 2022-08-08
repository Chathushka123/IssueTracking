<?php

namespace App\Http\Validators;

use App\Http\Validators\IssueCommonValidator;

class IssueCreateValidator
{
  public static function getCreateRules()
  {
    return array_merge([], IssueCommonValidator::getCommonRules());
  }
}