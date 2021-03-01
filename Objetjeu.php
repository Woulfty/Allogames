<?php
    
    class Jeu
    {
        private $_id;
        private $_nom;
        private $_type;
        private $_Affiche;
        private $_text;
        private $_background;
        private $_nbvue;
        private $_BDD;
        private $test;

        public function __construct($bdd, $id) {

            $query = $bdd->query("SELECT * FROM Game WHERE id = $id")->fetch();

            $nbrlike = $bdd->query("SELECT * FROM ArticleLike WHERE IDJeu =".$query["id"]);

            $this->_id = $query["id"];
            $this->_nom = $query["nom"];
            $this->_type = $query["type"];
            $this->_text = $query["texte"];

            //$this->_nbvue = $nbrlike->rowCount();

            $this->_BDD = $bdd;

        }

        public function showData() {

            echo "<script>document.body.style.backgroundImage = \"url('IMG/Games/".$this->_id."_background.jpg')\"</script>";
            print_r($this->test);
        }

        public function description(){
        ?>
        <div class="page">
            <div class="imgjeu">
                <!--met l'affiche du jeu selectioné dans la base-->
                <img class="imgjeu" src="IMG/Games/<?php echo $_GET['GameName']; ?>_Affiche.jpg" alt="Affiche">
            </div>
            <div class="desc">
                <?php
                    echo '<h1>'.$this->_nom.'</h1>';

                    //echo '<h1>'.$this->_nbvue.'👍</h1>';

                ?>
                <div class="espace40px"></div>
                <?php
                    //affiche une description du jeu
                    echo '<h3>'.$this->_text.'</h3>';
                ?>
            </div>
        </div>
        <?php
        }
        public function talk(){
            ?>
            <form action="" method="post">
            <h2 class="color">Entrez votre commentaire :</h2>
            <input class="texte" type="text" size="100" placeholder="Ecriver quelque-chose" name="comm">
            <input class="poster" type="submit" name='push' value="Poster">
            </form>
            <?php
                if (isset($_POST["push"])) {
                    //ajoute un commentaire dans la base de la page du jeu selectionné
                    $commentaire = $this->_BDD->query("INSERT INTO `commentaires`(`commentaire`, `iduser`, `idjeux`) VALUES (\"".$_POST['comm']."\",'".$_SESSION['idUser']."','".$_GET['GameName']."')");
                    if($commentaire){
                        //refresh la page après l'envoie du commentaire
                        echo '<meta http-equiv="refresh" content="0">';
                    } else {
                        echo "Une erreur est survenue.";
                    }
                }
        }

        public function commentaires(){
            ?>
                <u>
                    <h2 class="gris">Commentaires :</h2>
                </u>
            <?php
                //selectionne tout les commentaires du jeu et les affiches par ancienneté
                $CommResult = $this->_BDD->query("SELECT User.nom, User.pdp, commentaires.commentaire FROM User, commentaires 
                                                WHERE 
                                                    User.id = commentaires.iduser
                                                AND
                                                    commentaires.idjeux = '".$_GET['GameName']."'
                                                ORDER BY commentaires.id DESC");
                While($don = $CommResult->fetch()){
                    ?>
                    <div class="flex">

                        <div class="imguser">

                            <img class="imguser" src="IMG/Users/<?php echo $don['pdp']?>">

                        </div>
                        <div class="">

                            <?php
                                //affiche les commentaires et le pseudo de la persone qui a posté un commentaire
                                echo '<h3>'.$don['nom'].' :</h3>';
                                echo '<h4>'.$don['commentaire'].'</h4>';
                            ?>

                        </div>
                    </div>
                    <div class="esp"></div>
                    <?php
                }
        }

        public function Like(){
            ?>
            <form method="post">
                <input class="poster" type="submit" name='+1' value="👍">
            </form>

            <?php

                if(isset($_POST["+1"])) {
                    
                
                    $hasLike = $this->_BDD->query("SELECT * FROM ArticleLike WHERE IDUser = ".$_SESSION["idUser"]." AND IDJeu =".$this->_id."")->fetch();
 
                    if ($hasLike)
                        $this->_BDD->query("DELETE FROM ArticleLike WHERE IDUser = ".$_SESSION["idUser"]." AND IDJeu =".$this->_id);                    
                    else
                        $this->_BDD->query("INSERT INTO ArticleLike(IDUser, IDJeu) VALUES(".$_SESSION["idUser"].", $this->_id)");
                
                    echo '<meta http-equiv="refresh" content="0">';
                }

        }
 
    }
?>