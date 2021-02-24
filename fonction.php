<?php
    //connection a la base
    $MaBase = new PDO('mysql:host=localhost; dbname=site; charset=utf8','root');

    //fonction pour vérifier si l'utilisateur est bien connecter
    function check() {
        if($_SESSION && ( $_SESSION["Logged"] == true )) {
            return true;
        } else {
            return false;
        }
    }

    //fonction qui affiche le nom et l'image de profil de l'utilisateur
    function user(){
        ?>
            <a>
                <?php 
                    //selection dans ma base de l'utilisateur
                    $utilisateurs = $MaBase->query("SELECT * FROM `User` WHERE `id`='".$_SESSION["idUser"]."'");
                    $utilisateurs = $utilisateurs->fetch();
                    //Affiche l'image de profil de l'utilisateur via son id
                ?>
                <img class="image3" src="images/utilisateur/<?php echo $utilisateurs['pdp']?>">
                <?php
                    //Affiche le nom de l'utilisateur a la place du bouton
                    echo $utilisateurs['nom']; 
                ?>
            </a>
    }
?>