<?php
# inclusione del file di configurazione
include_once 'config.php';

# definizione della classe che conterrà i metodi per la gestione degli iscritti
class Iscrizioni {
  private $connessione;

  public function __construct() {
  // istanzio classe Iscrizioni che a sua volta istanzia classe DATA_Class 
  $this->data = new DATA_Class;
  // dalla DATA_Class mi faccio restituire l'oggetto connessione 
  $this->connessione = $this->data->get_conn();
  
  }
 
 
  # metodo per la registrazione 
  public function registra($nome_reale, $nome_utente, $password, $email) 
  {
    # tolgo eventuali spazi vuoti
    $nome_reale = trim($nome_reale);
    $nome_utente = trim($nome_utente);
    $password = trim($password);
    # verifico che il modulo sia stato compilato
    if (strlen($nome_reale) == 0 || strlen($nome_utente) == 0 || strlen($password) == 0) return false;
    else {
      # cifratura della password
      $password = @sha1($password);
      # confronto degli input con i dati contenuti in tabella
      $sql = "SELECT id_utente FROM iscritti WHERE nome_utente = '$nome_utente' OR email = '$email'";
      $risultato = $this->connessione->query($sql);
      # se il confronto non genera corrispondenze..
      if (!$risultato->num_rows) 
      {
        # ..si procede con la registrazione..
        $sql = "INSERT INTO iscritti(nome_utente, password, nome_reale, email) VALUES ('$nome_utente', '$password','$nome_reale','$email')";
        if (!$this->connessione->query($sql)) {
          die($this->connessione->error);
        }
        return true;
      }else{
        # ..altrimenti l'esito della registrazione sarà negativo
        return false;
      }
    }
  }

 
 # metodo per l'autenticazione
  public function verifica_login($email_o_nome_utente, $password) 
  {
    # cifratura della password
    $password = @sha1($password);
    # confronto degli input con i dati contenuti in tabella
    $sql = "SELECT id_utente FROM iscritti WHERE (email = '$email_o_nome_utente' OR nome_utente='$email_o_nome_utente') AND password = '$password'";
    $risultato = $this->connessione->query($sql);
    
    # controllo sulla presenza di una corrispondenza prodotta dal confronto
    # se il confronto genera una corrispondenza..
    if ($risultato->num_rows == 1) 
    {
      # ..viene generata la sessione di login..
      $row = $risultato->fetch_array(MYSQLI_ASSOC);
      $_SESSION['login'] = true;
      $_SESSION['id_utente'] = $row['id_utente'];
      return true;
    }else{
      # ..altrimenti l'esito dell'autenticazione sarà negativo
      return false;
    }
  }

  
  # metodo per la visualizzazione del nome dell'utente loggato
  public function mostra_utente($id_utente) 
  {
    # estrazione del nome reale sulla base dell'identificatore memorizzato in sessione
    $sql = "SELECT nome_reale FROM iscritti WHERE id_utente = $id_utente";
    $risultato = $this->connessione->query($sql);
    $row = $risultato->fetch_array(MYSQLI_ASSOC);
    # stampa a video del nome reale dell'utente
    echo $row['nome_reale'];
  }

  # metodo per il controllo sulla sessione
  public function verifica_sessione() 
  {
    # il metodo restituisce l'informazione relativa alla sessione a patto che questa sia stata inizializzata
    if(isset($_SESSION['login']))
    {
      return $_SESSION['login'];
    }else{
      return false;
    }
  }
  
  # metodo per il logout
  # la sessione viene distrutta a seguito di uno specifico input dell'utente
  public function esci() {
    $_SESSION['login'] = FALSE;
    @session_destroy();
    }
  }
?>