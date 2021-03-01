<?php
    session_start();
    include "fonction.php";
    include "Objetuser.php";

    if(check()){
        header("Location: index.php");
    }else{
        if($_SESSION['admin'] == 'true'){
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
                                        <form class="form1" enctype="multipart/form-data" method="post">
                                            <h2 class="gris">Ajouté un jeu :</h2>
                                            <!--rentrer le nom du jeu-->
                                            <p>
                                                <input class="input" type="text" placeholder="Nom du jeu" name="nom" required>
    
                                                <input class="input" type="text" placeholder="Type du jeu" name="type" required>
    
                                                <input class="input" type="text" placeholder="Synopsis du jeu" name="dudule" required>
    
                                                <h2 class="gris">Affiche du jeu :</h2>
                                                <!--ajout d'une image-->
                                                <input class="input" type="file" name='Affi' required/>
    
                                                <h2 class="gris">Background du jeu :</h2>
                                                <!--ajout d'une image-->
                                                <input class="input" type="file" name='back' required/>
            
                                                <input class="input" type="submit" name='subModif' value="Enregistrer un nouveau jeu">
                                            </p>
                                            <?php
                                                if (isset($_POST["subModif"])){
                                                    $note = $MaBase->query("INSERT INTO Game (`nom`,`texte`,`type`) VALUES (\"".$_POST['nom']."\",\"".$_POST['dudule']."\",\"".$_POST['type']."\")");
                                                    if($note){
                                                        echo"jeu ajouté";
                                                    }else{
                                                        echo"une erreur est survenu";
                                                    }
                                                
                                                    $valideType = array('.jpg');
                                                    if ($_FILES['Affi'] == 0) {
                                                        echo "aucun dossier selectionné";
                                                        die;
                                                    }
                                                    $fileType = ".".strtolower(substr(strrchr($_FILES['Affi']["name"], '.'), 1));
                                                    $req = $MaBase->query("SELECT id FROM Game ORDER BY id DESC LIMIT 1")->fetch();
                                                
                                                    $_FILES['Affi']["name"] = $req["id"]."_Affiche";
                                                    if (!in_array($fileType, $valideType)) {
                                                        echo "le fichier sélectionné n'est pas une image";
                                                        die;
                                                    }
                                                    $tmpName = $_FILES['Affi']['tmp_name'];
                                                    $Name = $_FILES['Affi']['name'];
                                                    $fileName = "IMG/Games/" . $Name.".jpg";
                                                    $résultUplod = move_uploaded_file($tmpName, $fileName);
                                                    if ($résultUplod) {
                                                        echo "Affiche enregister ";
                                                    }
                                                    //Background
                                                    if ($_FILES['back'] == 0) {
                                                        echo "aucun dossier selectionné";
                                                        die;
                                                    }
                                                    $fileType = ".".strtolower(substr(strrchr($_FILES['back']["name"], '.'), 1));
                                                
                                                    $_FILES['back']["name"] = $req["id"]."_background";
                                                    if (!in_array($fileType, $valideType)) {
                                                        echo "le fichier sélectionné n'est pas une image";
                                                        die;
                                                    }
                                                    $tmpName = $_FILES['back']['tmp_name'];
                                                    $Name = $_FILES['back']['name'];
                                                    $fileName = "IMG/Games/" . $Name.".jpg";
                                                    $résultUplod = move_uploaded_file($tmpName, $fileName);
                                                    if ($résultUplod) {
                                                        echo "Background enregister";
                                                    }
                                                
                                                }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                                <div class="arti3">
                                    <div class="form">
                                        <form class="form1" enctype="multipart/form-data" method="post">
                                            <h2 class="gris">Modifier/supprimer un jeu :</h2>
                                            <select name="remove">
                                                <?php $jeux = $MaBase->query("SELECT nom, id FROM Game"); 

                                                    while ($jeu = $jeux->fetch())
                                                        echo "<option value=".$jeu["id"].">".$jeu["nom"]."</option>";
                                                ?>

                                                <input class="input" type="submit" name="update" value="Modifier le jeu">

                                                <input class="input" type="submit" name="send" value="Supprimer le jeu">

                                            </select>
                                        </form>
                                        <form enctype="multipart/form-data" method="post" class="form1">
                                            <?php
                                                if (isset($_POST["update"])){ 
                                                    $gameData = $MaBase->query("SELECT * FROM Game WHERE id = ".$_POST["remove"])->fetch();
                                                ?> 
                                
                                                    <h2>Modification de <?= $gameData["nom"]; ?></h2>
                                
                                                    <p>ID du jeu :</p>
                                                    <!--rentrer le nom du jeu-->
                                                    <p><input class="input" type="text" name="id" value="<?= $_POST["remove"] ?>" readonly></p>
                                
                                                    <p>Nom du jeu :</p>
                                                    <!--rentrer le nom du jeu-->
                                                    <p><input class="input" type="text" placeholder="Entrer le nom du jeu" name="nom" value="<?= $gameData["nom"]; ?>" required></p>
                                
                                                    <p>Type du jeu :</p>
                                                    <!--rentrer le type du jeu-->
                                                    <p><input class="input" type="text" placeholder="Entrer le type du jeu" name="type" value="<?= $gameData["type"]; ?>" required></p>
                                
                                
                                                    <p>Bio du jeu :</p>
                                                    <!--rentrer la bio du jeu-->
                                                    <p><textarea type="text" placeholder="Entrer la bio du jeu" name="dudule" rows="5" cols="33" required><?= $gameData["texte"]; ?></textarea>
                                
                                                    <p>
                                                        Affiche du jeu :
                                                        <!--ajout d'une image-->
                                                        <input class="input" type="file" name='Affi'/>
                                                        <p>
                                                            <a href="<?= "IMG/Games/".$_POST["remove"]."_Affiche.jpg"?>">
                                                                <img src="<?= "IMG/Games/".$_POST["remove"]."_Affiche.jpg"?>" alt="" width="160px">
                                                            </a>
                                                        </p>
                                
                                                    </p>
                                                    
                                                    <p>
                                                        Background du jeu :
                                                        <!--ajout d'une image-->
                                                        <input class="input" type="file" name='back'/>
                                                        <p>
                                                            <a href="<?= "IMG/Games/".$_POST["remove"]."_background.jpg"?>">
                                                                <img src="<?= "IMG/Games/".$_POST["remove"]."_background.jpg"?>" alt="" width="300px">
                                                            </a>
                                                        </p>
                                                    </p>
                                                    <p>
                                                        <input class="input" type="submit" name='sendEdit' value="Enregistrer les modifications">
                                                    </p>
                                                <?php 
                                                }

                                                if (isset($_POST["sendEdit"])) {
                
                                                    $stm = $MaBase->prepare("UPDATE Game SET `nom` = ?, `type` = ?, `texte` = ? WHERE id = ".$_POST["id"]);
                                                    $stm->execute(array(
                                                        $_POST["nom"],
                                                        $_POST["type"],
                                                        $_POST["dudule"],
                                                    ));
                                    
                                                    $valideType = array('.jpg');
                                                    
                                                    if (!$_FILES['Affi']["name"]) die;
                                    
                                                    echo "pass";
                                    
                                                    $fileType = ".".strtolower(substr(strrchr($_FILES['Affi']["name"], '.'), 1));
                                    
                                                    $_FILES['Affi']["name"] = $_POST["id"]."_Affiche";
                                                    
                                                    if (!in_array($fileType, $valideType)) {
                                                        echo "le fichier sélectionné n'est pas une image";
                                                        die;
                                                    }
                                    
                                                    $tmpName = $_FILES['Affi']['tmp_name'];
                                                    $Name = $_FILES['Affi']['name'];
                                                    $fileName = "IMG/Games/" . $Name.".jpg";
                                                    $résultUplod = move_uploaded_file($tmpName, $fileName);
                                                    if ($résultUplod) {
                                                        echo "Affiche enregister ";
                                                    }
                                                    //Background
                                                    if ($_FILES['back'] == 0) {
                                                        echo "aucun dossier selectionné";
                                                        die;
                                                    }
                                                    $fileType = ".".strtolower(substr(strrchr($_FILES['back']["name"], '.'), 1));
                                    
                                                    $_FILES['back']["name"] = $_POST["id"]."_background";
                                                    
                                                    if (!in_array($fileType, $valideType)) {
                                                        echo "le fichier sélectionné n'est pas une image";
                                                        die;
                                                    }
                                                    $tmpName = $_FILES['back']['tmp_name'];
                                                    $Name = $_FILES['back']['name'];
                                                    $fileName = "IMG/Games/" . $Name.".jpg";
                                                    $résultUplod = move_uploaded_file($tmpName, $fileName);
                                                    if ($résultUplod) {
                                                        echo "Background enregister";
                                                    }
                                    
                                                }
                                    
                                                if (isset($_POST["send"])){
                                    
                                                    $id = $_POST["remove"]; 
                                                    $MaBase->query("DELETE FROM commentaires WHERE idjeux = ".$id);
                                                    $MaBase->query("DELETE FROM ArticleLike WHERE IDJeu = ".$id);
                                                    $MaBase->query("DELETE FROM Game WHERE id = ".$id);
                                    
                                                    $affiche    = "IMG/Games/".$id."_Affiche.jpg";
                                                    $background = "IMG/Games/".$id."_background.jpg";
                                    
                                                    if (file_exists($affiche)) {
                                                        unlink($affiche);
                                                        echo "L'affiche a bien été supprimée";
                                                    } else echo "L'affiche n'a pas été supprimée";
                                    
                                                    if (file_exists($background)) {
                                                        unlink($background);
                                                        echo "Le background a bien été supprimée";
                                                    } else echo "Le background n'a pas été supprimée";
                                                }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </body>
                    <?php
        }
    }
    ?>
</html>