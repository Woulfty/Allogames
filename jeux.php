<?php
    session_start();
    include "fonction.php";
    include "Objetjeu.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/class.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            $gameName = $MaBase->query("SELECT nom FROM Game WHERE id = ".$_GET['GameName'])->fetch();
            echo $gameName["nom"]
        ?>
    </title>
</head>
<body>
    <?php

        include "menu.php";

    ?>
    <div class="arti1">
        <div class="biojeu">
            <?php

                $game = new Jeu($MaBase, $_GET['GameName']);

                $game->showData();

                $game->description();

                
                if(check()){

                    ?>
                        <h2 class="gris">
                            <a class="bouton" href="connexion.php">Partage ton avis, connecte toi !</a>
                        </h2>
                    <?php

                }else{

                    $game->Like();

                    $game->talk();

                }
                

                $game->commentaires();

            ?>
        </div>
    </div>
    </body>
</html> 