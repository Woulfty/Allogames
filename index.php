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
    <link rel="stylesheet" href="CSS/menu.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>acceuil</title>
</head>
<body>
    <div class="space">
        <div class="menu">
        <?php
            if(check()){
                user();
            }else{
                ?>
                    <a href="connexion.php">Connexion</a>
                <?php
            }
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
        <div class="arti">
            <div class="espace"></div>
            <div>
                <u>
                    <h1 class="gris">Tendances du moment :</h1>
                </u>
                <div class="esp"></div>
                <div class="box">
                    <?php
                        /*
                        $CommResult = $MaBase->query("SELECT COUNT(*), IDJeu, nom FROM `ArticleLike` INNER JOIN Game ON ArticleLike.IDJeu = Game.id GROUP BY IDJeu ORDER BY `COUNT(*)` DESC LIMIT 3");
                        While($don = $CommResult->fetch()){
                        ?>
                        <div class="bloc">
                            <?php
                                echo "<script>document.body.style.backgroundImage = \"url('IMG/Games/".$this->_id."_background.jpg')\"</script>";
                                print_r($this->test);
                            ?>
                            <a class="page center comm" href="jeux.php?GameName=<?= $don['IDJeu']; ?>">
                                <div class="img">
                                <!--met l'affiche du jeu selectioné dans la base-->
                                    <img class="Affiche1" src="images/Nouveaudossier/<?= $don['IDJeu']; ?>_Affiche.jpg" alt="Affiche">
                                </div>
                                <div class="center">
                                    <?php
                                    //affiche les commentaires et le pseudo de la persone qui a posté un commentaire
                                        echo '<h1 class="color3">'.$don['nom'].'</h1>';
                                        echo '<h1 class="color3">'.$don['COUNT(*)'].'👍</h1>';
                                    */
                                    ?>
                                </div>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>