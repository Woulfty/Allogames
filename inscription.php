<?php
    session_start();
    include "fonction.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/class.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="" /><!--icone de l'onglet-->
    <title>Connexion</title>
</head>
<body>
    <div class="space">
        <?php
            include "menu.php"
        ?>
        <div class="arti3">
            <div class="form">
                <form class="form1" action="" method="post">
                    <p>
                        <?php
                            //sélection du nombre d'utilisateur
                            $nb = $MaBase->query("SELECT COUNT(*) FROM user");
                            $gens = $nb->fetch();

                            echo '<h1>Déjà '.$gens['COUNT(*)'].' membres !</h1>';
                        ?>
                    </p>
                    <u>
                        <h2 class="gris">Inscription :</h2>
                    </u>
                    <input class="input" type="text" placeholder="Entrez votre Pseudo" name="nom" maxlength="10" required>

                    <input class="input" type="password" placeholder="Entrez votre mot de passe" name="MDP" required>

                    <input class="input" type="password" placeholder="Confirmer le mot de passe" name="password" id="confirmpassword" required>

                    <input class="input" type="submit" name='submit' value="S'inscrire">
                    <u>
                        <h2 class="gris">
                            <p>Tu a déjà un compte ?<p>
                            <a class="bouton" href="connexion.php">Retour a la connexion</a>
                        </h2>
                    </u>
                    <?php
                        if (isset($_POST["submit"])) {

                            $exist = $MaBase->query("SELECT COUNT(*) FROM User WHERE nom ='".$_POST['nom']."'");
                            $exist = $exist->fetch();

                            if ($exist["COUNT(*)"] > 0) {

                                echo '<h3 class="desct">Cet utilisateur existe déjà...</h3>';
                                return;
                            
                            }else{

                                if($_POST['MDP'] == $_POST['password']) {
                                    $insert = $MaBase->query("INSERT INTO User(nom, MDP,pdp,admin) VALUES('".$_POST['nom']."','".$_POST['MDP']."','default.png','false')");

                                        if($insert->rowCount()>=1){

                                            $Result = $MaBase->query("SELECT * FROM `User` WHERE `nom`='".$_POST['nom']."' AND `MDP` = '".$_POST['MDP']."'");
                                                if($Result->rowCount()>0){

                                                    header("location: index.php");
                                                    $tab = $Result->fetch();
                                                    //si il existe et que le mot de passe correspond -> connection
                                                    $_SESSION["Logged"] = true;
                                                    $_SESSION["idUser"] = $tab['id'];
                                                    $_SESSION["admin"] = $tab['admin'];
                                                }
                                        }
                    
                                }else{
                                    echo '<h3 class="desct">Les mots de passe ne corespondes pas...</h3>';
                                }
                            }
                        }
                    ?>
                    <div class="gif">
                        <img class="gif" src="IMG/Backgrounds/HoNo.PNG">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>