<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
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
    <h1>Mot de passe oublié</h1>
    <div></div>
    </div>
    <hr>
    <div class="forgot">
        <form action="" method="post">
            <div class="mb-3">
                <input type="email" class="form-control" id="forgot_email" name="forgot_email"
                    placeholder="Adresse E-Mail" required>
            </div>
            <button type="submit" name="forgot" class="btn btn-primary">Envoyer le mail de récupération</button>
        </form>
    </div>
</body>

</html>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if (isset($_POST['forgot'])) {
        $server = 'localhost';
        $user = 'root';
        $password = '';
        $bdd = 'nfe114';
        $conn = new mysqli($server, $user, $password, $bdd);
        if (!$conn) {
            echo "<script>alert('Une erreur a eu lieu');</script>";
        }
        
        if (isset($_POST['forgot_email'])) {
            $email = $_POST['forgot_email'];
        }
        else{
            $email = "";
        }

        if ((str_contains($email, "&") || str_contains($email, "\"") || str_contains($email, "'") || str_contains($email, "(") || str_contains($email, ")") || str_contains($email, "=") || str_contains($email, "$") || str_contains($email, "*") || str_contains($email, "!") || str_contains($email, ":") || str_contains($email, ";") || str_contains($email, "~") || str_contains($email, "#") || str_contains($email, "{") || str_contains($email, "[") || str_contains($email, "|") || str_contains($email, "`") || str_contains($email, "\\") || str_contains($email, "^") || str_contains($email, "]") || str_contains($email, "}") || str_contains($email, "°") || str_contains($email, "+") || str_contains($email, "¨") || str_contains($email, "£") || str_contains($email, "¤") || str_contains($email, "µ") || str_contains($email, "%") || str_contains($email, "§") || str_contains($email, "/") || str_contains($email, "?") || str_contains($email, "<") || str_contains($email, ">") || str_contains($email, "²"))) {
            echo "<script>alert('Des champs contiennent des caractères interdits. Pour rappel, on ne peut utiliser que des lettres, ou des chiffres dans le cas du mail et du mot de passe.')</script>";
        }
        if ($email == "") {
            echo "<script>alert('Veuillez indiquer votre adresse e-mail')</script>";
        }
        else {

            $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email'");
            $num_row = mysqli_num_rows($query);
            if ($num_row == 0) {
                echo "<script>alert('Votre email n'est pas enregistré')</script>";
            }
            else {
                $req0 = $conn->query("SELECT `token` FROM `users` WHERE `email` = '$email'");
                $row0 = $req0->fetch_assoc();
                $token = $row0['token'];
                $req = $conn->query("SELECT * FROM `users` WHERE `token` = '$token'");
                $row = $req->fetch_assoc();
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                $user_mail = $row['email'];
                require 'D:\damie\xampp\htdocs\nfe114_1\vendor\phpmailer\phpmailer\src\Exception.php';
                require 'D:\damie\xampp\htdocs\nfe114_1\vendor\phpmailer\phpmailer\src\PHPMailer.php';
                require 'D:\damie\xampp\htdocs\nfe114_1\vendor\phpmailer\phpmailer\src\SMTP.php';

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

                $mail->Subject    =  'Changement de mot de passe';
                // $mail->MsgHTML("Bonjour,<br>Vous venez de demander un changement de mot de passe. <strong>Si vous n'êtes pas à l'origine de cette demande, merci de ne pas la prendre en compte.</strong><br>S'il s'agit bien de vous, cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :<br><a href='https://747f-185-189-23-50.ngrok.io/change_forgot.php?$token'>Modifier votre mot de passe</a><br><br>Toute l'équipe espère que vous vous plairez sur notre site.<br><br><small>En cas de problème de connexion, n'hésitez pas à contacter l'équipe en répondant à ce mail.</small>");
                $mail->MsgHTML("Bonjour,<br>Vous venez de demander un changement de mot de passe. <strong>Si vous n'êtes pas à l'origine de cette demande, merci de ne pas la prendre en compte.</strong><br>S'il s'agit bien de vous, cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :<br><a href='http://localhost/change_forgot.php?$token'>Modifier votre mot de passe</a><br><br>Toute l'équipe espère que vous vous plairez sur notre site.<br><br><small>En cas de problème de connexion, n'hésitez pas à contacter l'équipe en répondant à ce mail.</small>");
                $mail->IsHTML(true);

                $fullname = "$prenom"." "."$nom";
                $mail->AddAddress("$user_mail","$fullname");

                if (!$mail->send()) {
                    echo "<script>alert('Une erreur a eu lieu')</script>";
                }
                else {
                    echo "<script>alert('Un mail de réinitialisation de mot de passe vous a été envoyé. Vous pourrez le réinitiliser depuis ce mail.');window.location.href = './';</script>";
                }
            }
        }
    }
?>