<?php

class PaymentsManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'user_id', 'credit_card_number', 'cvv', 'expiration1', 'expiration2', 'paypal', 'principal');
    $this->tableName = 'Payments';
  }

  public function getPayments($userid)
  {
    return $this->db->query("SELECT * FROM Payments WHERE user_id = '$userid'");
  }

  public function addPayment($userID, $credit_card_number, $cvv, $expiration) {

    $expiration1 = substr($expiration, 0, 2);
    $expiration2 = substr($expiration, 3, 5);

    return $this->db->query("INSERT INTO Payments (user_id, credit_card_number, cvv, expiration1, expiration2, paypal) VALUES ($userID, $credit_card_number, $cvv, $expiration1, $expiration2, 0)");
  }

  public function setPrincipal($id, $principal)
  {
    return $this->db->query("UPDATE Payments SET principal = $principal WHERE id = $id");
  }

  public function remove($id)
  {
    return $this->delete($id);
  }
}
