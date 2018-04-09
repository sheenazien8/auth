<?php
  /**
   *
   */
  class User
  {
    private $_db;
    public function __construct()
    {
      $this->_db = Database::getInstance();
    }

    public function register_user($fields = array())
    {
      if ($this->_db->insert('user', $fields)) return true;
      else return false;

    }
    public function loginUser($username,$password)
    {

      $data = $this->_db->getInfo('user', 'username', $username );

      if (password_verify($password, $data['password'])) {
        return true;
      }else {
        return false;
      }
    }
    public function checkNama($username)
    {
      $data = $this->_db->getInfo('user', 'username', $username );
      if (empty($data)) {
        return false;
      }else {
        return true;
      }
    }
  }

?>
