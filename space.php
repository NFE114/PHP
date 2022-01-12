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
    <title>Espace</title>
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
        <div style="padding: 25px;"><a href="./"><i class="fa fa-home" style="color: black;" aria-hidden="true">&nbsp&nbsp&nbspAccueil</i></a></div>
        <h1>Espace utilisateur</h1>
        <div class="right" style="padding-right: 25px;">
            <form action="" method="post">
                <button type="submit" name="logout" style="border: none; background-color: transparent; margin-left: -5px"><i class="fa fa-sign-out" aria-hidden="true">&nbsp&nbspDéconnexion</i></button><br>
                <a type="button" href="change.php"><i class="fa fa-lock" aria-hidden="true" style="color: black;">&nbsp&nbsp&nbspChanger le mot de passe</i></a>
            </form>
        </div>
    </div>
    <?php
        if (isset($_POST['logout'])) {
            session_start();
            session_unset();
            session_destroy();
            unset($_SESSION["id"]);
            unset($_SESSION["name"]);
            unset($_SESSION['user']);
            $_SESSION['user'] = "not_username";
            header('location:./');
            echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
        }
    ?>
    <hr>
    <h2>Choisir les rapports à afficher</h2>
    <div class="content filters">
        <form action="" method="post" class="space_form">
            <?php
                $server = 'localhost';
                $user = 'root';
                $password = '';
                $bdd = 'nfe114';
                $connection = new mysqli($server, $user, $password, $bdd);
                $connection2 = new mysqli($server, $user, $password, $bdd);
                if (!$connection) {
                    echo "<script>alert('Une erreur a eu lieu');</script>";
                }
                $res = $connection->query("SELECT DISTINCT `vendeur` FROM `rapports`");
                echo "<select name='vendeur' id='vendeur'>";
                echo "<option value='' disabled selected>Vendeur</option>";
                while($row = $res->fetch_assoc()){
                    echo "<option name='".$row['vendeur']."'>".$row['vendeur']."</option>";
                }
                echo "</select><br><br>";

                $res2 = $connection2->query("SELECT DISTINCT `region` FROM `rapports`");
                echo "<select name='regions' id='regions'>";
                echo "<option value='' disabled selected>Région</option>";
                while($row2 = $res2->fetch_assoc()){
                    echo "<option name='".$row2['region']."'>".$row2['region']."</option>";
                }
                echo "</select><br><br>";
            ?>
            <input type="number" name="min_montant" id="min_montant" placeholder="Montant minimum">
            <input type="number" name="max_montant" id="max_montant" placeholder="Montant maximum"><br><br>
            <input type="date" name="date" id="date" min="2000-01-01" max="2100-12-31"><br><br>
            <input type="submit" name="filtre" value="Filtrer">
            <input type="submit" name="reinit" value="Réinitialiser"><br><br>
            <input type="submit" name="liste" value="Liste complète de tous les rapports (ordonnée par vendeur)">
        </form>
    </div>
</body>

</html>

<?php
    if (isset($_POST['filtre'])) {
        $server = 'localhost';
        $user = 'root';
        $password = '';
        $bdd = 'nfe114';
        $connection = new mysqli($server, $user, $password, $bdd);
        if (!$connection) {
            echo "<script>alert('Une erreur a eu lieu');</script>";
        }
        if (isset($_POST['vendeur'])) {
            $vendeur = $_POST['vendeur'];
        }
        else{
            $vendeur = "";
        }
        if (isset($_POST['regions'])) {
            $region = $_POST['regions'];
        }
        else{
            $region = "";
        }
        if (isset($_POST['min_montant'])) {
            $min = $_POST['min_montant'];
        }
        else {
            $min = "";
        }
        if (isset($_POST['max_montant'])) {
            $max = $_POST['max_montant'];
        }
        else {
            $max = "";
        }
        if (isset($_POST['date'])) {
            $date = $_POST['date'];
        }
        else {
            $date = "";
        }
        $res = $connection->query("SELECT * FROM `rapports` WHERE `vendeur` LIKE '%".$vendeur."%' AND `region` LIKE '%".$region."%' AND `montant` BETWEEN '$min' AND '$max' AND `date` LIKE '%".$date."% 00:00:00'");
        echo "<div style='margin-left: 40%;'><br>";
        echo "Date - Région - Vendeur - Montant<br><br>";
        $filename = 'liste.csv';
        if (file_exists($filename)) {
            unlink($filename);
        }
        $fp = fopen($filename, 'a');
        while($row = $res->fetch_assoc()){
            echo $row['date']." - ".$row['region']." - ".$row['vendeur']." - ".$row['montant']."€<br>";
            $somecontent = $row['date']." - ".$row['region']." - ".$row['vendeur']." - ".$row['montant']."€\r\n";
            if (fwrite($fp, $somecontent) === FALSE) {
                echo "Erreur";
                exit;
            }
        }
        fclose($fp);
        $fc = file_get_contents($filename);
        if ($fc != "") {
            echo "<br><a style='margin-left: 10%;' href=\"$filename\" name=\"export\"><button>Exporter les données</button></a>";
        }
        else{
            echo "Aucune donnée";
        }
        echo "</div>";
    }
    if (isset($_POST['reinit'])) {
        echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
    }
        ?>

<?php
if (isset($_POST['liste'])) {
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $bdd = 'nfe114';
    $connection = new mysqli($server, $user, $password, $bdd);
    if (!$connection) {
        echo "<script>alert('Une erreur a eu lieu');</script>";
    }
    $res = $connection->query("SELECT * FROM `rapports` ORDER BY `vendeur`");
    echo "<div style='margin-left: 40%;'><br>";
    echo "Date - Région - Vendeur - Montant<br><br>";
    $filename = 'liste.csv';
    if (file_exists($filename)) {
        unlink($filename);
    }
    $fp = fopen($filename, 'a');
    while($row = $res->fetch_assoc()){
        echo $row['date']." - ".$row['region']." - ".$row['vendeur']." - ".$row['montant']."€<br>";
        $somecontent = $row['date']." - ".$row['region']." - ".$row['vendeur']." - ".$row['montant']."€\r\n";
        if (fwrite($fp, $somecontent) === FALSE) {
            echo "Erreur";
            exit;
        }
    }
    fclose($fp);
    echo "<a href=\"$filename\" name=\"export\"><button>Exporter les données</button></a>";
    echo "</div>";
}
echo "<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>";
?>