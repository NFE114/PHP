<?php 
session_start();
$server = 'localhost';
$user = 'root';
$password = '';
$bdd = 'nfe114';
$le = $_SESSION['user'];
$connection = new mysqli($server, $user, $password, $bdd);
if (!$connection) {
    echo "<script>alert('Une erreur a eu lieu');</script>";
}
$query = mysqli_query($connection, "SELECT * FROM `users` WHERE `email`='$le'");
$num_row = mysqli_num_rows($query);
if ($num_row == 0) {
    header('Location: ./');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de mot de passe</title>
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
    <div style="padding: 25px;"><a href="space.php" style="color: black;"><i class="fa fa-backward" aria-hidden="true">&nbsp&nbsp Retour</i></a></div>
    <h1>Changement de mot de passe</h1>
    <div></div>
    </div>
    <hr>
    <div class="change">
        <form action="" method="post">
            <div class="mb-3">
                <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control" id="change_password_old" name="change_password_old"
                    placeholder="Ancien mot de passe" required>
            </div>
            <div class="mb-3">
                <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control" id="change_password" name="change_password"
                    placeholder="Nouveau mot de passe" required>
            </div>
            <div class="mb-3">
                <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control" id="confirm_change_password" name="confirm_change_password"
                    placeholder="Confirmez le nouveau mot de passe" required>
            </div>
            <button type="submit" name="change" class="btn btn-primary">Changer le mot de passe</button>
        </form>
    </div>
</body>

</html>
<?php
if (isset($_POST['change'])) {
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $bdd = 'nfe114';
    $le = $_SESSION['mail'];
    $conn = new mysqli($server, $user, $password, $bdd);
    if (!$conn) {
        echo "<script>alert('Une erreur a eu lieu');</script>";
    }

    $mail = $le;
    if (isset($_POST['change_password_old'])) {
        $old = md5($_POST['change_password_old']);
    }
    else {
        $old = "";
    }
    if (isset($_POST['change_password'])) {
        $new = md5($_POST['change_password']);
    }
    else {
        $new = "";
    }
    if (isset($_POST['confirm_change_password'])) {
        $cnew = md5($_POST['confirm_change_password']);
    }
    else {
        $cnew = "";
    }
    if ((str_contains($old, "&") || str_contains($old, "\"") || str_contains($old, "'") || str_contains($old, "(") || str_contains($old, "-") || str_contains($old, "_") || str_contains($old, ")") || str_contains($old, "=") || str_contains($old, "$") || str_contains($old, "*") || str_contains($old, "ù") || str_contains($old, "!") || str_contains($old, ":") || str_contains($old, ";") || str_contains($old, ",") || str_contains($old, "~") || str_contains($old, "#") || str_contains($old, "{") || str_contains($old, "[") || str_contains($old, "|") || str_contains($old, "`") || str_contains($old, "\\") || str_contains($old, "^") || str_contains($old, "@") || str_contains($old, "]") || str_contains($old, "}") || str_contains($old, "°") || str_contains($old, "+")|| str_contains($old, "¨") || str_contains($old, "£") || str_contains($old, "¤") || str_contains($old, "µ") || str_contains($old, "%") || str_contains($old, "§") || str_contains($old, "/") || str_contains($old, ".") || str_contains($old, "?") || str_contains($old, "<") || str_contains($old, ">") || str_contains($old, "²")) || (str_contains($new, "&") || str_contains($new, "\"") || str_contains($new, "'") || str_contains($new, "(") || str_contains($new, "-") || str_contains($new, "_") || str_contains($new, ")") || str_contains($new, "=") || str_contains($new, "$") || str_contains($new, "*") || str_contains($new, "ù") || str_contains($new, "!") || str_contains($new, ":") || str_contains($new, ";") || str_contains($new, ",") || str_contains($new, "~") || str_contains($new, "#") || str_contains($new, "{") || str_contains($new, "[") || str_contains($new, "|") || str_contains($new, "`") || str_contains($new, "\\") || str_contains($new, "^") || str_contains($new, "@") || str_contains($new, "]") || str_contains($new, "}") || str_contains($new, "°") || str_contains($new, "+")|| str_contains($new, "¨") || str_contains($new, "£") || str_contains($new, "¤") || str_contains($new, "µ") || str_contains($new, "%") || str_contains($new, "§") || str_contains($new, "/") || str_contains($new, ".") || str_contains($new, "?") || str_contains($new, "<") || str_contains($new, ">") || str_contains($new, "²")) || (str_contains($cnew, "&") || str_contains($cnew, "\"") || str_contains($cnew, "'") || str_contains($cnew, "(") || str_contains($cnew, "-") || str_contains($cnew, "_") || str_contains($cnew, ")") || str_contains($cnew, "=") || str_contains($cnew, "$") || str_contains($cnew, "*") || str_contains($cnew, "ù") || str_contains($cnew, "!") || str_contains($cnew, ":") || str_contains($cnew, ";") || str_contains($cnew, ",") || str_contains($cnew, "~") || str_contains($cnew, "#") || str_contains($cnew, "{") || str_contains($cnew, "[") || str_contains($cnew, "|") || str_contains($cnew, "`") || str_contains($cnew, "\\") || str_contains($cnew, "^") || str_contains($cnew, "@") || str_contains($cnew, "]") || str_contains($cnew, "}") || str_contains($cnew, "°") || str_contains($cnew, "+")|| str_contains($cnew, "¨") || str_contains($cnew, "£") || str_contains($cnew, "¤") || str_contains($cnew, "µ") || str_contains($cnew, "%") || str_contains($cnew, "§") || str_contains($cnew, "/") || str_contains($cnew, ".") || str_contains($cnew, "?") || str_contains($cnew, "<") || str_contains($cnew, ">") || str_contains($cnew, "²"))) {
        echo "<script>alert('Des champs contiennent des caractères interdits. Pour rappel, on ne peut utiliser que des lettres, ou des chiffres dans le cas du mail et du mot de passe.')</script>";
    }
    else if ($old == "") {
        echo "<script>alert('Veuillez indiquer votre ancien mot de passe')</script>";
    }
    else if ($new == "") {
        echo "<script>alert('Veuillez indiquer votre nouveau mot de passe')</script>";
    }
    else if ($cnew == "") {
        echo "<script>alert('Veuillez confirmer votre nouveau mot de passe')</script>";
    }
    else {
        $req = $conn->query("SELECT `password` FROM `users` WHERE `email` = '$mail'");
        $row = $req->fetch_assoc();

        if ($row['password'] == $new) {
            echo "<script>alert('Vous ne pouvez pas utiliser votre mot de passe actuel comme nouveau mot de passe.')</script>";
        }
        elseif ($new == $cnew && $row['password'] != $new) {
            $upd = $conn->query("UPDATE `users` SET `password` = '$new' WHERE `email` = '$mail'");
            echo "<script>alert('Votre mot de passe a bien été mis à jour');window.location.href = 'space.php';</script>";
        }
        else {
            echo "<script>alert('Une erreur a eu lieu.')</script>";
        }
    }
}
?>