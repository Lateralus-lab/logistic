<?php

class Customer
{

  private $db;
  private $email;

  public function __construct($email)
  {
    $this->db = new Database();
    $this->email = $email;
  }

  public function isEmailTaken()
  {

    $sql = "SELECT * FROM customers
            WHERE `email` = :email";

    $values = [
      [':email', $this->email]
    ];

    $result = $this->db->queryDB($sql, Database::EXECUTE, $values);

    return $result ? true : false;
  }

  public function addCustomer($name, $phone)
  {

    $sql = "INSERT INTO customers (`name`, `phone`, `email`, `created_at`)
            VALUES (:name, :phone, :email, :created_at)";

    $values = [
      [':name', $name],
      [':phone', $phone],
      [':email', $this->email],
      [':created_at', date('Y-m-d H:i:s')],
    ];

    $this->db->queryDB($sql, Database::EXECUTE, $values);
  }

  public function getCustomerIdByEmail()
  {
    $sql = "SELECT * FROM customers
            WHERE `email` = :email";

    $values = [
      [':email', $this->email]
    ];

    $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values);

    if ($result > 0) {
      return $result['id'];
    }
  }
}
