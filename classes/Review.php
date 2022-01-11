<?php

class Review
{
  public $id;
  public $title;
  public $message;
  public $vote;
  public $userID;
  public $productID;

  public function __construct($id, $title, $message, $vote, $userID, $productID)
  {
    $this->id = (int) $id;
    $this->title = $title;
    $this->message = $message;
    $this->vote = (int) $vote;
    $this->userID = $userID;
    $this->productID = $productID;
  }
}

class ReviewManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'title', 'message', 'vote', 'blocked','user_id', 'product_id');
    $this->tableName = 'Review';
  }

  public function getReviews($productID)
  {

    $reviews = 0;

    $result = $this->db->query("SELECT * FROM Review WHERE product_id = '$productID' AND blocked = 0");

    if (count($result) > 0) {
      return $result;
    }
    return $reviews;
  }

  public function add($title, $message, $vote, $userID, $productID)
  {
    return $this->db->query("INSERT INTO Review (title, message, vote, user_id, product_id) VALUES('$title', '$message', '$vote', '$userID', '$productID')");
  }

  public function updateReview($title, $message, $vote, $userID, $productID)
  {
    return $this->db->query("UPDATE Review SET title = '$title', message = '$message', vote = $vote WHERE user_id = $userID AND product_id = $productID");
  }

  public function getAvg($productID)
  {
    return $this->db->query("SELECT AVG(vote) AS 'media' FROM Review WHERE product_id = $productID AND blocked=0");
  }

  public function checkReview($userID, $productID)
  {

    $result = $this->db->query("SELECT * FROM Review WHERE user_id = '$userID' AND product_id = '$productID' AND blocked=0");

    if (count($result) > 0) {
      return true;
    }
    return false;
  }

  /* FUNZIONIO PER LA DASHBOARD */
  public function getLastReview(){
    return $this->db->query("SELECT Review.vote AS 'vote', Review.title AS 'title', Review.message AS 'message', User.name AS 'user', Product.name AS 'product' FROM Review, User, Product WHERE User.id=Review.user_id AND Product.id=Review.product_id ORDER BY Review.id DESC LIMIT 3");
  }

  public function getAllOrder(){
    return $this->db->query("SELECT *FROM Review ORDER BY Review.id DESC");
  }

  public function blockReview($reviewID){
    $this->db->query("UPDATE Review SET blocked=1 WHERE id=$reviewID");
  }

  public function unlockReview($reviewID){
    $this->db->query("UPDATE Review SET blocked=0 WHERE id=$reviewID");
  }
}
