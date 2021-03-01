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
                                        <form class="form1" method="post">
                                            <select name="remove">
                                                <?php 
                                                    $users = $MaBase->query("SELECT * FROM user"); 

                                                    while ($user = $users->fetch())
                                                        echo "<option value=".$user["id"].">".$user["nom"]."</option>";
                                                ?>
                                                <input class="input" type="submit" name="supuser" value="Supprimer le jeu">
                                                <?php
                                                    if (isset($_POST["supuser"])){
                                    
                                                        $id = $_POST["id"]; 
                                                        $MaBase->query("DELETE FROM commentaires WHERE iduser = ".$id);
                                                        $MaBase->query("DELETE FROM User WHERE id = ".$id);
                                                ?>
                                            </select>
