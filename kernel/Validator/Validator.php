<?php

namespace Kernel\Validator;

class Validator
{
  private $errros = [];
  private array $data = [];
  
  public function validate(array $data, array $rules): bool
  {

    $this->data = $data;
    $this->errors = [];

    foreach($rules as $key => $rule){
      $rules = $rule;

      foreach($rules as $rule){
        // min:3 => [min, 3]
        $rule = explode(':', $rule);

        $ruleName = $rule[0];
        $ruleValue = $rule[1] ?? null;

        $error = $this->validateRule($key, $ruleName, $ruleValue);

        if($error){
          $this->errors[$key][] = $error;
        }
      }
    }

    return empty($this->errors);
  }

  public function validateRule(string $key, string $ruleName, string|null $ruleValue): string|false{
    $value = $this->data[$key];

    switch($ruleName){
      case 'required': 
        if(empty($value)){
          return "Failed $key is required";
        }
        break;
      case 'min':
        if(strlen($value) < $ruleValue){
          return "Failed $key must be at least {$ruleValue} characters long";
        }
        break;
      case 'max':
        if(strlen($value) > $ruleValue){
          return "Failed $key must be at most {$ruleValue} characters long";
        }
        break;
    }

    return false;
  }

  public function getErrors(): array{
    return $this->errors;
  }
}