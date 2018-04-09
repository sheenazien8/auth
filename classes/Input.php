<?php
  class Input extends Database
  {
    public static function get_post($name)
    {
      if (isset($_POST[$name])) {
        return $_POST[$name];
      }else if (isset($_GET[$name])) {
        return $_GET[$name];
      }
      return false;
    }

  }



?>
