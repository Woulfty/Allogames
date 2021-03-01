<nav>
    <div class="menu">
        <div class="esp"></div>
        <?php
            if(check()){
                ?>
                    <h2>
                        <a class="text" href="connexion.php">Connexion</a>
                    </h2>
                <?php
            }else{
                //selection dans ma base de l'utilisateur
                $utilisateurs = $MaBase->query("SELECT * FROM `User` WHERE `id`='".$_SESSION["idUser"]."'");
                $utilisateurs = $utilisateurs->fetch();
                //Affiche l'image de profil de l'utilisateur via son id
                ?>
                    <a href="compte.php">
                        <?php
                            //Affiche le nom de l'utilisateur a la place du bouton
                            echo '<h2 class="text">'.$utilisateurs['nom'].'</h2>';
                        ?>
                    </a>
                <?php
            }
            ?>
                <h2>
                    <a class="text" href="index.php">Accueil</a>
                </h2>
            <?php

            if(check()){
            
            }else{
                if($_SESSION['admin'] == 'true'){
                    ?>
                        <h2>
                            <a class="admin" href="ajoutjeu.php">Jeux</a>
                            <div class="esp"></div>
                            <div class="esp"></div>
                            <a class="admin" href="users.php">Utilisateurs</a>
                        </h2>
                    <?php
                }
            }

                //si dans ma base l'utilisateur est Admin alors il a accés a un bouton qui méne vers la page admin
                   
            $gameType = $MaBase->query("SELECT type FROM `Game` GROUP BY type");
            foreach ($gameType as $type => $data){ 
            ?>
                <h2>    
                    <div class="esp"></div>
                    <a class="text" href="liste.php?TypeName=<?= $data['type']; ?>"><?= $data['type']; ?></a>
                    <div class="esp"></div>
                </h2>
            <?php 
            } 

            if(check()){
                echo '<h2 class="text3"> U ω U </h2>';
            }else{
                deco();
                ?>
                    <div class="esp"></div>
                <?php
            }

        ?>
    </div>
</nav>