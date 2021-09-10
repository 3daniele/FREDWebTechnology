<?php

class User
{
  public $id;
  public $name;
  public $surname;
  public $email;
  public $password;
  public $img;
  public $user_type;

  public function __construct($id, $name, $surname, $email, $password, $img, $user_type)
  {
    $this->id = (int)$id;
    $this->name = $name;
    $this->surname = $surname;
    $this->email = $email;
    $this->password = $password;
    $this->img = $img;
    $this->user_type = $user_type;
  }
}

class UserManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'name', 'surname', 'email', 'password', 'img', 'user_type');
    $this->tableName = 'User';
  }

  public function login($email, $password)
  {
    return $this->db->query("SELECT* FROM User WHERE email = '$email' AND password = '$password'");
  }

  public function register($name, $surname, $email, $password)
  {
    $user = new User(0, $name, $surname, $email, $password, 'public/img/account.svg', 1);
    $userID = $this->create($user);

    return $userID;
  }

  //helper per verificare che un'email non sia già stata utilizzata
  public function checkEmail($email)
  {
    $result = $this->db->query("SELECT * FROM User WHERE email = '$email'");

    return count($result) > 0;
  }

  //helper per verificare che le password coincidono
  public function checkPassword($password, $confPassword)
  {
    return $password == $confPassword;
  }

  public function data($email)
  {
    return $this->db->query("SELECT * FROM User WHERE email = '$email'");
  }

  public function getName($id){
    return $this->db->query("SELECT name, img FROM User WHERE id = $id");
  }
}
