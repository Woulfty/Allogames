<?php
    session_start();
    include "fonction.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/class.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="" /><!--icone de l'onglet-->
    <title>acceuil</title>
</head>
<body>
    <div class="space">
        <div class="menu">
            <h2>
                <a class="text1" href="index.php">Acceuil</a>
                <div class="esp"></div>
                <div class="esp"></div>
                <a class="text2" href="connexion.php">Connexion</a>
            </h2>
        <?php
            
            /*
            if(check()){
                //user();


                //condition de session


                echo "coucou";
            }else{
                ?>
                    <a href="connexion.php">Connexion</a>
                <?php
            }
            */


            $gameType = $MaBase->query("SELECT type FROM `Game` GROUP BY type");
            foreach ($gameType as $type => $data){ ?>
                <h2>
                    <div class="esp"></div>
                    <a class="text" href="liste.php?TypeName=<?= $data['type']; ?>"><?= $data['type']; ?></a>
                    <div class="esp"></div>
                </h2>
            <?php 
            } 
        ?>
        </div>
        <div class="arti2">

            <?php
                $CommResult = $MaBase->query("SELECT * FROM `Game` WHERE `type` = '".$_GET['TypeName']."'");
                While($don = $CommResult->fetch()){
                    ?>
                        <div class="center">
                            <a  class="comm" href="jeux.php?GameName=<?php echo $_POST['GameName']= $don['id']; ?>">
                                <div class="img">
                                <!--met l'affiche du jeu selectioné dans la base-->
                                    <img class="Affiche" src="IMG/Games/<?php echo $don['id']; ?>_Affiche.jpg" alt="Affiche">
                                </div>
                                <div class="center nom">
                                    <?php
                                        //affiche le nom du jeu
                                        echo '<h1>'.$don['nom'].'</h1>';
                                    ?>
                                </div>
                            </a>
                            <div class="esp"></div>
                        </div>
                    <?php
                }   
            ?>
        </div>
</body>
</html>