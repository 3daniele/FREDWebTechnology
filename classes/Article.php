<?php

class ArticleManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'title', 'text', 'img');
    $this->tableName = 'Article';
  }

  public function newArticle($title, $text, $img){
    $titlebis = addslashes($title);
    $textbis= addslashes($text);
    return $this->db->query("INSERT INTO Article (title,text,img) VALUES ('$titlebis','$textbis', '$img')");
  }

  public function getLast(){
    return $this->db->query("SELECT *FROM Article ORDER BY id DESC");
  }

  public function updateArticle($id, $title, $text, $img)
  {
    $titlebis = addslashes($title);
    $textbis= addslashes($text);
    $imgbis= addslashes($img);
    return $this->db->query("UPDATE Article SET title='$titlebis', text='$textbis', img='$imgbis' WHERE id='$id'");
  }

  public function updateImg($id) {
    $imgbis = "/public/img/slider/slide" . $id . ".png";
    return $this->db->query("UPDATE Article SET img='$imgbis' WHERE id='$id'");
  }
}
