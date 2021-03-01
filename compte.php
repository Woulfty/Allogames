<?php
    session_start();
    include "fonction.php";
    include "Objetuser.php";

    if(check()){
        header("Location: index.php");
    }else{
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
                <form enctype="multipart/form-data" class="form1" action="" method="post">
                    <p>
                        <?php
                            $utilisateurs = $MaBase->query("SELECT * FROM `User` WHERE `id`='".$_SESSION["idUser"]."'");
                            $utilisateurs = $utilisateurs->fetch();

                            echo '<h2>'.$utilisateurs['nom'].'</h2>';
                        ?>
                    </p>
                    <?php

                        $user = new User($MaBase, $_SESSION["idUser"]);

                        $user->PDP();

                        $user->sécu();

                    ?>
                </form>
            </div>
        </div>
    </div>

    <!--mettre le script js pour l'image de profil  (default)-->

    <?php
    }
    ?>
</body>