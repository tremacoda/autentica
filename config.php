<?php
class DATA_Class 
{
// connessione privata passata output dal metodo get_conn()
private $connessione;
// parametri per la connessione al database
private $servername = "localhost";
private $username = "root";
private $password = "";
private $dbname = "registrazione";
  
// funzione per la connessione a MySQL
public function __construct()
{
$this->connessione = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
// Check connection
if ($this->connessione->connect_error) {
  die('Errore di connessione (' . $this->connessione->connect_errno . ') '. $this->connessione->connect_error);
} else {
//  echo 'Connesso. ' . $connessione->host_info . "\n";
}
} // end construct

public function get_conn() {
return $this->connessione;
}
} // end class
?>