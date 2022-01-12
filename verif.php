<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de l'email</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fapplication-blondel.com%2Fimages%2Ficon-512x512.png" type="image/x-icon">
    <script>
        document.onkeydown = function(e) {
  if(event.keyCode == 123) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
     return false;
  }
}
    </script>
</head>

<body oncontextmenu="return false;">
<div class="header">
    <div style="padding: 25px;"><a href="./" style="color: black;"><i class="fa fa-home" aria-hidden="true">&nbsp&nbsp Accueil</i></a></div>
    <h1>Vérification de l'adresse e-mail</h1>
    <div></div>
    </div>
    <hr>
    
</body>
</html>

<?php
$url = $_SERVER['REQUEST_URI'];
$pos = strrpos($url, '/');
$id = $pos === false ? $url : substr($url, $pos + 11);
$token = $id;
// $token = $_SESSION['token'];
$server = 'localhost';
$user = 'root';
$password = '';
$bdd = 'nfe114';
$conn = new mysqli($server, $user, $password, $bdd);
if (!$conn) {
    echo "<script>alert('Une erreur a eu lieu');</script>";
}
$res = $conn->query("SELECT DISTINCT `valid` FROM `users` WHERE `token` = '$token'");
$row = $res->fetch_assoc();

if ($row != null && $row['valid'] == 1) {
    echo "<div style='display: flex; justify-content: center'><p>Vous avez déjà validé votre e-mail !</p></div>";
}
else {
    echo "<div style='display: flex; justify-content: center'><form action='' method='post'><input type='submit' class='btn btn-primary' name='verif' id='verif' value='Vérifier votre email'></form</div>";
    if (isset($_POST['verif'])) {
        $req = $conn->query("UPDATE `users` SET `valid` = 1 WHERE `token` = '$token'");
        echo "<script>alert('Votre e-mail a bien été vérifié');window.location.href = './';</script>";
        echo "<script>document.getElementById('verif').disable = true;</script>";
    }
}

?>