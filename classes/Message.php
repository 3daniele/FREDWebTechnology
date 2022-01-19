<?php

class MessageManager extends DbManager{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'chat_id', 'broadcast', 'message', 'date','displayed');
    $this->tableName = 'Message';
  }

  public function getLast($chatID){
    return $this->db->query("SELECT *FROM Message WHERE chat_id = '$chatID' ORDER BY date DESC LIMIT 1");
  }

  public function getMessage($chatID){
    return $this->db->query("SELECT *FROM Message WHERE chat_id = '$chatID' ORDER BY date DESC LIMIT 5 ");
  }

  public function newMessage($chatID, $message){
    //INSERT INTO `Message` (`id`, `chat_id`, `broadcast`, `message`, `date`, `displayed`) VALUES (NULL, '5', '0', 'Ordine pronto per il ritiro', CURRENT_TIMESTAMP, '0');
    $this->db->query("INSERT INTO Message (chat_id, message) VALUES ($chatID,'$message')");
  }

  public function newMessageB($chatID, $message){
    //INSERT INTO `Message` (`id`, `chat_id`, `broadcast`, `message`, `date`, `displayed`) VALUES (NULL, '5', '0', 'Ordine pronto per il ritiro', CURRENT_TIMESTAMP, '0');
    $this->db->query("INSERT INTO Message (chat_id, broadcast, message) VALUES ($chatID,'1','$message')");
  }

}