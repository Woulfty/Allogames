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
    <title>Accueil</title>
</head>
<body>
    <div class="space">
        <?php
            include "menu.php"
        ?>
        <div class="arti1">

            <img src='IMG/bg/1.jpg' id="bg" style="display: block;">
            <img src='IMG/bg/2.jpg' id="bg" style="display: none;" >
            <img src='IMG/bg/3.jpg' id="bg" style="display: none;" >
            <img src='IMG/bg/4.jpg' id="bg" style="display: none;" >
            <img src='IMG/bg/5.jpg' id="bg" style="display: none;" >
            <img src='IMG/bg/6.jpg' id="bg" style="display: none;" >

            <script type="text/javascript">

                I = 0 ;
                Imax = document.images.length - 1 ;
                setTimeout(suivante, 3000) ;
    
                function suivante(){
                    document.images[I].style.display = "none" ;
                    if ( I < Imax )
                        I++;
                    else
                        I=0;    
                    document.images[I].style.display = "block";
                    setTimeout(suivante, 3000) ;
                }
            </script>
        </div>
        <div class="arti3">
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
                                    <a class="comm" href="jeux.php?GameName=<?= $don['IDJeu']; ?>">
                                        <div class="img">
                                        <!--met l'affiche du jeu selectioné dans la base-->
                                            <img class="Affiche" src="images/Nouveaudossier/<?= $don['IDJeu']; ?>_Affiche.jpg" alt="Affiche">
                                        </div>
                                        <div class="center">
                                            <?php
                                            //affiche les commentaires et le pseudo de la persone qui a posté un commentaire
                                                echo '<h1 class="color3">'.$don['nom'].'</h1>';
                                                echo '<h1 class="color3">'.$don['COUNT(*)'].'👍</h1>';
                                            ?>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        }
                        */
                    ?>
                </div>
                <u>
                    <h1 class="gris">A découvrir :</h1>
                </u>
                <div class="esp"></div>
                <?php

                    $CommResult = $MaBase->query("SELECT * FROM `Game`");
                    While($don = $CommResult->fetch()){
                        ?>
                            <div class="center">
                                <a  class="zone" href="jeux.php?GameName=<?php echo $_POST['GameName']= $don['id']; ?>">
                                    <div class="img1">
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
        </div>
    </div>
</body>
</html>