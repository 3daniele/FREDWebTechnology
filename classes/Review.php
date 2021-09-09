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
    $this->columns = array('id', 'title', 'message', 'vote', 'user_id', 'product_id');
    $this->tableName = 'Review';
  }

  public function getReviews($productID)
  {

    $reviews = 0;

    $result = $this->db->query("SELECT * FROM Review WHERE product_id = '$productID'");

    if (count($result) > 0) {
      return $result;
    }
    return $reviews;
  }

  public function add($title, $message, $vote, $userID, $productID)
  {
    /*
    $reviewID = 0;

    $reviewID = $this->create([
      'title' => $title,
      'message' => $message,
      'vote' => $vote,
      'user_id' => $userID,
      'product_id' => $productID
    ]);

    return $reviewID;
    */

    return $this->db->query("INSERT INTO Review (title, message, vote, user_id, product_id) VALUES('$title', '$message', '$vote', '$userID', '$productID')");
  }

  public function getAvg($productID)
  {
    return $this->db->query("SELECT AVG(vote) AS 'media' FROM review WHERE product_id = $productID");
  }

  public function checkReview($userID, $productID)
  {

    $result = $this->db->query("SELECT * FROM Review WHERE user_id = '$userID' AND product_id = '$productID'");

    if (count($result) > 0) {
      return true;
    }
    return false;
  }
}
