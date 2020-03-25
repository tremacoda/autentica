<?php
# inizializzazione della sessione
@session_start();
# inclusione del file di funzione
@include_once 'functions.php';
# istanza della classe
$obj = new Iscrizioni();
# chiamata al metodo per la verifica della sessione
if ($obj->verifica_sessione())
{
  # redirect in caso di esito positivo
  @header("location:area_riservata.php");
}
# chiamata al metodo per l'autenticazione
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  $login = $obj->verifica_login(htmlentities($_POST['email_o_nome_utente'], ENT_QUOTES), htmlentities($_POST['password'], ENT_QUOTES));
  # controllo sull'esito del metodo
  if ($login) {
    # redirect in caso di esito positivo
    @header("location:area_riservata.php");
  }else{
    # notifica in caso di esito negativo
    echo 'I dati indicati non sono corretti.';
  }
}
# form per l'autenticazione
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Pagina per l'autenticazione</title>
</head>
<body>
<div id="container">
  <div id="main-body">
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form_autenticazione" name="autenticazione">
  <div class="head"><h1>Per poter accedere devi autenticarti</h1></div>
  <label>Inserisci l'email o il nome utente</label><br/>
  <input type="text" name="email_o_nome_utente" /><br/>
  <label>Inserisci la password</label><br/>
  <input type="password" name="password" id="password" /><br/>
  <input type="submit" name="invio_dati" value="Invia"/><br/><br/>
  <label><a href="iscrizione.php" title="Registrazione">Se non sei registrato puoi farlo adesso</a></label>
  </form>
  </div>
</div>
</body>
</html>