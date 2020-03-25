<?php
# inclusione del file di funzione
include_once 'functions.php';
# istanza della classe Iscrizioni 
$obj = new Iscrizioni();
# chiamata al metodo per la verifica della sessione
if ($obj->verifica_sessione())
{
  #redirect in caso di esito negativo
  @header("location:area_riservata.php");
}
# chiamata al metodo per la registrazione
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $registrato = $obj->registra(htmlentities($_POST['nome_reale'], ENT_QUOTES), htmlentities($_POST['nome_utente'], ENT_QUOTES), htmlentities($_POST['password'], ENT_QUOTES), htmlentities($_POST['email'], ENT_QUOTES));
  # controllo sull'esito del metodo
  if ($registrato) {
    # notifica in caso di esito positivo
    echo 'Registrazione conclusa <a href="autenticazione.php">ora puoi loggarti</a>.';
  }else{
    # notifica in caso di esito negativo
    echo 'Il form non è stato compilato correttamente oppure stai cercando di registrarti con dei dati gi&aacute; presenti nel database.';
  }
}
# form per l'iscrizione
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Pagina per la registrazione</title>
</head>
<body>
<div id="container">
  <div id="main-body">
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form_registrazione" name="registrazione">
    <div class="head"><h1>Registrazione iscritti</h1></div>
    <label>Nome</label><br/>
    <input type="text" name="nome_reale" /><br/>
    <label>Nome utente</label><br/>
    <input type="text" name="nome_utente" /><br/>
    <label>Password</label><br/>
    <input type="password" name="password" /><br/>
    <label>Il tuo indirizzo di posta elettronica</label><br/>
    <input type="text" name="email" id="email" /><br/><br/>
    <input type="submit" name="registra" value="Registrami"/><br/><br/>
    <label><a href="autenticazione.php" title="Login">Se sei già registrato puoi loggarti da qui</a></label> 
  </form>
  </div>
</div>
</body>
</html>