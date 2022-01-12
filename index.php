<?php session_start() ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['register'])) {

    $showAlert = false; 
    $showError = false; 
    $exists=false;
        
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $server = 'localhost';
        $user = 'root';
        $password = '';
        $bdd = 'nfe114';
        $conn = new mysqli($server, $user, $password, $bdd);
        if (!$conn) {
            echo "<script>alert('Une erreur a eu lieu');</script>";
        }
        
        
        if (isset($_POST["username"])) {
            $user_mail = $_POST["username"];
        }
        else {
            $user_mail = "";
        }
        if (isset($_POST["nom"])) {
            $nom = $_POST["nom"];
        }
        else {
            $nom = "";
        }
        if (isset($_POST["prenom"])) {
            $prenom = $_POST["prenom"];
        }
        else {
            $prenom = "";
        }
        if (isset($_POST["password"])) {
            $password = $_POST["password"];
        }
        else {
            $password = "";
        }
        if (isset($_POST["cpassword"])) {
            $cpassword = $_POST["cpassword"];
        }
        else {
            $cpassword = "";
        }
        $token = md5(crypt($user_mail, $nom));
        $sql = "Select * from `users` where `email`='$user_mail'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result); 
        $valid = 0;
        $_SESSION['token'] = $token;
        $fullname = $prenom." ".$nom;
        if($num == 0) {
            if ((str_contains($nom, "&") || str_contains($nom, "\"") || str_contains($nom, "'") || str_contains($nom, "(") || str_contains($nom, "-") || str_contains($nom, "_") || str_contains($nom, ")") || str_contains($nom, "=") || str_contains($nom, "$") || str_contains($nom, "*") || str_contains($nom, "ù") || str_contains($nom, "!") || str_contains($nom, ":") || str_contains($nom, ";") || str_contains($nom, ",") || str_contains($nom, "~") || str_contains($nom, "#") || str_contains($nom, "{") || str_contains($nom, "[") || str_contains($nom, "|") || str_contains($nom, "`") || str_contains($nom, "\\") || str_contains($nom, "^") || str_contains($nom, "@") || str_contains($nom, "]") || str_contains($nom, "}") || str_contains($nom, "°") || str_contains($nom, "+") || str_contains($nom, "0") || str_contains($nom, "1") || str_contains($nom, "2") || str_contains($nom, "3") || str_contains($nom, "4") || str_contains($nom, "5") || str_contains($nom, "6") || str_contains($nom, "7") || str_contains($nom, "8") || str_contains($nom, "9") || str_contains($nom, "¨") || str_contains($nom, "£") || str_contains($nom, "¤") || str_contains($nom, "µ") || str_contains($nom, "%") || str_contains($nom, "§") || str_contains($nom, "/") || str_contains($nom, ".") || str_contains($nom, "?") || str_contains($nom, "<") || str_contains($nom, ">") || str_contains($nom, "²")) || (str_contains($prenom, "&") || str_contains($prenom, "\"") || str_contains($prenom, "'") || str_contains($prenom, "(") || str_contains($prenom, "-") || str_contains($prenom, "_") || str_contains($prenom, ")") || str_contains($prenom, "=") || str_contains($prenom, "$") || str_contains($prenom, "*") || str_contains($prenom, "ù") || str_contains($prenom, "!") || str_contains($prenom, ":") || str_contains($prenom, ";") || str_contains($prenom, ",") || str_contains($prenom, "~") || str_contains($prenom, "#") || str_contains($prenom, "{") || str_contains($prenom, "[") || str_contains($prenom, "|") || str_contains($prenom, "`") || str_contains($prenom, "\\") || str_contains($prenom, "^") || str_contains($prenom, "@") || str_contains($prenom, "]") || str_contains($prenom, "}") || str_contains($prenom, "°") || str_contains($prenom, "+") || str_contains($prenom, "0") || str_contains($prenom, "1") || str_contains($prenom, "2") || str_contains($prenom, "3") || str_contains($prenom, "4") || str_contains($prenom, "5") || str_contains($prenom, "6") || str_contains($prenom, "7") || str_contains($prenom, "8") || str_contains($prenom, "9") || str_contains($prenom, "¨") || str_contains($prenom, "£") || str_contains($prenom, "¤") || str_contains($prenom, "µ") || str_contains($prenom, "%") || str_contains($prenom, "§") || str_contains($prenom, "/") || str_contains($prenom, ".") || str_contains($prenom, "?") || str_contains($prenom, "<") || str_contains($prenom, ">") || str_contains($prenom, "²")) || (str_contains($user_mail, "&") || str_contains($user_mail, "\"") || str_contains($user_mail, "'") || str_contains($user_mail, "(") || str_contains($user_mail, ")") || str_contains($user_mail, "=") || str_contains($user_mail, "$") || str_contains($user_mail, "*") || str_contains($user_mail, "!") || str_contains($user_mail, ":") || str_contains($user_mail, ";") || str_contains($user_mail, "~") || str_contains($user_mail, "#") || str_contains($user_mail, "{") || str_contains($user_mail, "[") || str_contains($user_mail, "|") || str_contains($user_mail, "`") || str_contains($user_mail, "\\") || str_contains($user_mail, "^") || str_contains($user_mail, "]") || str_contains($user_mail, "}") || str_contains($user_mail, "°") || str_contains($user_mail, "+") || str_contains($user_mail, "¨") || str_contains($user_mail, "£") || str_contains($user_mail, "¤") || str_contains($user_mail, "µ") || str_contains($user_mail, "%") || str_contains($user_mail, "§") || str_contains($user_mail, "/") || str_contains($user_mail, "?") || str_contains($user_mail, "<") || str_contains($user_mail, ">") || str_contains($user_mail, "²")) || (str_contains($password, "&") || str_contains($password, "\"") || str_contains($password, "'") || str_contains($password, "(") || str_contains($password, "-") || str_contains($password, "_") || str_contains($password, ")") || str_contains($password, "=") || str_contains($password, "$") || str_contains($password, "*") || str_contains($password, "ù") || str_contains($password, "!") || str_contains($password, ":") || str_contains($password, ";") || str_contains($password, ",") || str_contains($password, "~") || str_contains($password, "#") || str_contains($password, "{") || str_contains($password, "[") || str_contains($password, "|") || str_contains($password, "`") || str_contains($password, "\\") || str_contains($password, "^") || str_contains($password, "@") || str_contains($password, "]") || str_contains($password, "}") || str_contains($password, "°") || str_contains($password, "+")|| str_contains($password, "¨") || str_contains($password, "£") || str_contains($password, "¤") || str_contains($password, "µ") || str_contains($password, "%") || str_contains($password, "§") || str_contains($password, "/") || str_contains($password, ".") || str_contains($password, "?") || str_contains($password, "<") || str_contains($password, ">") || str_contains($password, "²")) || (str_contains($cpassword, "&") || str_contains($cpassword, "\"") || str_contains($cpassword, "'") || str_contains($cpassword, "(") || str_contains($cpassword, "-") || str_contains($cpassword, "_") || str_contains($cpassword, ")") || str_contains($cpassword, "=") || str_contains($cpassword, "$") || str_contains($cpassword, "*") || str_contains($cpassword, "ù") || str_contains($cpassword, "!") || str_contains($cpassword, ":") || str_contains($cpassword, ";") || str_contains($cpassword, ",") || str_contains($cpassword, "~") || str_contains($cpassword, "#") || str_contains($cpassword, "{") || str_contains($cpassword, "[") || str_contains($cpassword, "|") || str_contains($cpassword, "`") || str_contains($cpassword, "\\") || str_contains($cpassword, "^") || str_contains($cpassword, "@") || str_contains($cpassword, "]") || str_contains($cpassword, "}") || str_contains($cpassword, "°") || str_contains($cpassword, "+")|| str_contains($cpassword, "¨") || str_contains($cpassword, "£") || str_contains($cpassword, "¤") || str_contains($cpassword, "µ") || str_contains($cpassword, "%") || str_contains($cpassword, "§") || str_contains($cpassword, "/") || str_contains($cpassword, ".") || str_contains($cpassword, "?") || str_contains($cpassword, "<") || str_contains($cpassword, ">") || str_contains($cpassword, "²"))) {
                echo "<script>alert('Des champs contiennent des caractères interdits. Pour rappel, on ne peut utiliser que des lettres, ou également des chiffres dans le cas du mail et du mot de passe.')</script>";
            }
            else if ($user_mail == "") {
                echo "<script>alert('Veuillez indiquer une adresse e-mail')</script>";
            }
            else if ($nom == "") {
                echo "<script>alert('Veuillez indiquer votre nom')</script>";
            }
            else if ($prenom == "") {
                echo "<script>alert('Veuillez indiquer votre prénom')</script>";
            }
            else if ($password == "") {
                echo "<script>alert('Veuillez choisir un mot de passe')</script>";
            }
            else if(($password == $cpassword) && $exists==false) {
        
                $hash = md5($password);
                    
                $sql = "INSERT INTO `users` ( `nom`, 
                    `prenom`, `email`, `password`, `token`, `valid`) VALUES ('$nom', 
                    '$prenom', '$user_mail', '$hash', '$token', $valid)";
        
                $result = mysqli_query($conn, $sql);
        
                if ($result) {
                    $showAlert = true; 
                }

                require '.\vendor\phpmailer\phpmailer\src\Exception.php';
                require '.\vendor\phpmailer\phpmailer\src\PHPMailer.php';
                require '.\vendor\phpmailer\phpmailer\src\SMTP.php';

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPAuth = 1;

                if($mail->SMTPAuth){
                $mail->SMTPSecure = 'ssl';
                $mail->Username   =  'connexionprogramme@gmail.com'; 
                $mail->Password   =  '@MotDePasse50$';
                }
                $mail->CharSet = 'UTF-8';
                $mail->smtpConnect();

                $mail->setFrom('connexionprogramme@gmail.com', 'Prgramme de connexion');
                $mail->FromName   = 'Programme de connexion';

                $mail->Subject    =  'Validation du compte';
                // $mail->MsgHTML("Bonjour,<br>Vous venez de vous inscrire sur notre site. Pour pouvoir y accéder, veuillez cliquer sur le lien ci-dessous pour valider votre adresse e-mail :<br><a href='https://747f-185-189-23-50.ngrok.io/verif.php?$token'>Vérifier votre adresse e-mail</a><br><br>Toute l'équipe espère que vous vous plairez sur notre site.<br><br><small>En cas de problème de connexion, n'hésitez pas à contacter l'équipe en répondant à ce mail.</small>");
                $mail->MsgHTML("Bonjour,<br>Vous venez de vous inscrire sur notre site. Pour pouvoir y accéder, veuillez cliquer sur le lien ci-dessous pour valider votre adresse e-mail :<br><a href='http://localhost/verif.php?$token'>Vérifier votre adresse e-mail</a><br><br>Toute l'équipe espère que vous vous plairez sur notre site.<br><br><small>En cas de problème de connexion, n'hésitez pas à contacter l'équipe en répondant à ce mail.</small>");
                $mail->IsHTML(true);

                $fullname = "$prenom"." "."$nom";
                $mail->AddAddress("$user_mail","$fullname");

                if (!$mail->send()) {
                    echo "<script>alert('Une erreur a eu lieu')</script>";
                }

            } 
            else { 
                $showError = "Les mots de passe ne correspondent pas"; 
            }      
        }
        
    if($num>0)
    {
        $exists="Cet email est déjà utilisé"; 
    } 
        
    }
    echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <h1>Accueil</h1>
    <hr>
    <div class="container">
        <div class="login">
            <h2>Connexion</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <input type="email" class="form-control" id="login_email" name="login_email"
                        placeholder="Adresse E-Mail" required>
                </div>
                <div class="mb-3">
                    <input type="password" pattern="[a-zA-Z0-9]+" class="form-control" id="login_password" name="login_password"
                        placeholder="Mot de passe" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Connexion</button>
            </form>
            <a href="forgot.php">Mot de passe oublié</a>
        </div>
        <div class="trait"></div>
        <div class="signin">
            <h2>Inscription</h2>
            <?php
    if (isset($_POST['register'])) {
        if($showAlert) {
        
            echo "<script>alert('Votre compte a bien été créé')</script>";
        }
        
        if($showError) {
        
            echo "<script>alert('".$showError."')</script>";
    }
            
        if($exists) {
            echo "<script>alert('".$exists."')</script>";
        }
    }
?>
    
<div>
    
    <form action="" method="post">
    
        <div class="form-group mb-3"> 
        <input type="email" class="form-control" id="username" name="username" placeholder="E-Mail" required>
        </div>

        <div class="form-group mb-3"> 
        <input type="text" pattern="[a-zA-Z]+" title="Les chiffres et caractères spéciaux ne sont pas acceptés" class="form-control" id="nom"
            name="nom" placeholder="Nom" required>    
        </div>

        <div class="form-group mb-3"> 
        <input type="text" pattern="[a-zA-Z]+" title="Les chiffres et caractères spéciaux ne sont pas acceptés" class="form-control" id="prenom"
            name="prenom" placeholder="Prénom" required>    
        </div>
    
        <div class="form-group mb-3"> 
            <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control"
            id="password" name="password" placeholder="Mot de passe" required> 
        </div>
    
        <div class="form-group mb-3"> 
            <input type="password" pattern="[a-zA-Z0-9]+" title="Les caractères spéciaux ne sont pas acceptés" class="form-control"
                id="cpassword" name="cpassword" placeholder="Confirmer le mot de passe" required>
        </div>      
    
        <button type="submit" name="register" class="btn btn-primary">
        S'enregistrer
        </button> 
    </form> 
</div>
        </div>
    </div>
</body>

</html>

<?php
	if (isset($_POST['login'])){
        $server = 'localhost';
        $user = 'root';
        $password = '';
        $bdd = 'nfe114';
        $connection = new mysqli('localhost', $user, $password, $bdd);
        if (!$connection) {
            echo "<script>alert('Une erreur a eu lieu');</script>";
        }
            if (isset($_POST["login_email"])) {
                $le = $_POST["login_email"];
            }
            else{
                $le = "";
            }
            if (isset($_POST["login_password"])) {
                $lp = md5($_POST["login_password"]);
            }
            else{
                $lp = "";
            }
            if ((str_contains($le, "&") || str_contains($le, "\"") || str_contains($le, "'") || str_contains($le, "(") || str_contains($le, ")") || str_contains($le, "=") || str_contains($le, "$") || str_contains($le, "*") || str_contains($le, "!") || str_contains($le, ":") || str_contains($le, ";") || str_contains($le, "~") || str_contains($le, "#") || str_contains($le, "{") || str_contains($le, "[") || str_contains($le, "|") || str_contains($le, "`") || str_contains($le, "\\") || str_contains($le, "^") || str_contains($le, "]") || str_contains($le, "}") || str_contains($le, "°") || str_contains($le, "+") || str_contains($le, "¨") || str_contains($le, "£") || str_contains($le, "¤") || str_contains($le, "µ") || str_contains($le, "%") || str_contains($le, "§") || str_contains($le, "/") || str_contains($le, "?") || str_contains($le, "<") || str_contains($le, ">") || str_contains($le, "²")) || (str_contains($lp, "&") || str_contains($lp, "\"") || str_contains($lp, "'") || str_contains($lp, "(") || str_contains($lp, "-") || str_contains($lp, "_") || str_contains($lp, ")") || str_contains($lp, "=") || str_contains($lp, "$") || str_contains($lp, "*") || str_contains($lp, "ù") || str_contains($lp, "!") || str_contains($lp, ":") || str_contains($lp, ";") || str_contains($lp, ",") || str_contains($lp, "~") || str_contains($lp, "#") || str_contains($lp, "{") || str_contains($lp, "[") || str_contains($lp, "|") || str_contains($lp, "`") || str_contains($lp, "\\") || str_contains($lp, "^") || str_contains($lp, "@") || str_contains($lp, "]") || str_contains($lp, "}") || str_contains($lp, "°") || str_contains($lp, "+")|| str_contains($lp, "¨") || str_contains($lp, "£") || str_contains($lp, "¤") || str_contains($lp, "µ") || str_contains($lp, "%") || str_contains($lp, "§") || str_contains($lp, "/") || str_contains($lp, ".") || str_contains($lp, "?") || str_contains($lp, "<") || str_contains($lp, ">") || str_contains($lp, "²"))) {
                echo "<script>alert('Des champs contiennent des caractères interdits. Pour rappel, on ne peut utiliser que des lettres, ou également des chiffres dans le cas du mail et du mot de passe.')</script>";
            }
            else if ($le == "") {
                echo "<script>alert('Veuillez indiquer votre adresse e-mail')</script>";
            }
            else if ($lp == "") {
                echo "<script>alert('Veuillez indiquer votre')</script>";
            }
            else {
                $_SESSION['mail'] = $le;
                $req = $connection->query("SELECT `valid` FROM `users` WHERE `email` = '$le'");
                $row = $req->fetch_assoc();
                if ($row['valid']) {
                    $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `password`='$lp' and `email`='$le'");
                    $row = mysqli_fetch_array($query);
                    $num_row = mysqli_num_rows($query);
                    
                    if ($num_row > 0) 
                        {			
                            $_SESSION['user'] = $le;
                            header('location:space.php');
                            
                        }
                    else
                        {
                            echo "<script>alert('Identifiants invalides')</script>";
                            echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
                        }
                }
            else {
                echo "<script>alert('Vous n\'avez pas validé votre adresse e-mail ou créé votre compte')</script>";
                echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}; location.reload()</script>";
            }
        }
        echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
    }
  ?>