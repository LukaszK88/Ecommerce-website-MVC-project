<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 20/09/2016
 * Time: 16:21
 */
class Validation{
    private $_passed = false;
     static  $_errors = array();
      private      $_db = null;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = $source[$item];

                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be minimum {$rule_value} characters");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be less than {$rule_value} characters");
                            }
                            break;
                        case 'value':
                            if (($value) < $rule_value) {
                                $this->addError("{$item} must be {$rule_value} or more");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()) {
                                $this->addError("{$item} already exists");
                            }
                            break;
                        case 'email':
                            if ((filter_var($value, FILTER_VALIDATE_EMAIL)) === false) {
                                $this->addError("{$item} must be valid email address");
                            }
                            break;
                    }

                }
            }
        }

        if (empty(self::$_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error)
    {
       self::$_errors[] = $error;
    }

    public static function displayErrors(){
        if(!empty(self::errors())) {
            echo '<div class="alert alert-danger text-center">';
            foreach (self::errors() as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        }
    }

    public function errors()
    {
        return self::$_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }

}