<?php
  class Validation{
    private $_passed = false,
            $_errors = array();

    public function check($items = array())
    {
      foreach ($items as $item => $rules) :
        foreach ($rules as $rule => $rule_value) :
          switch ($rule) {
            case 'requeired':
              if (trim(Input::get_post($item)) == false && $rule_value ==true) {
                $this->addError("$item wajib diisi");
              }
              break;
            case 'min':
              if (strlen(Input::get_post($item)) < $rule_value ) {
                $this->addError("$item tidak boleh kurang dari $rule_value");
              }
              break;
            case 'max':
              if (strlen(Input::get_post($item)) > $rule_value) {
                $this->addError("$item tidak boleh lebih dari $rule_value");
              }
              break;

            default:

              break;
          }
        endforeach;
      endforeach;

      //kalau nggak error maka passnya true
      if (empty($this->_errors)) {
        $this->_passed = true;
      }

      return $this;
    }

    private function addError($error)
    {
      $this->_errors [] = $error;
    }

    public function erros()
    {
      return $this->_errors;
    }

    public function passed()
    {
      return $this->_passed;
    }
  }

?>
