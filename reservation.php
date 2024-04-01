<?php
   session_start();


   if(isset($_POST['root'])&&
      isset($_POST[''])) {
        //connexion a la base

        $db_username='root';
        $db_password='';
        $db_name='police';
        $db_serveur='localhost';

         $db = mysqli_connect($db_serveur, $db_username, $db_password,$db_name)
         or die('Impossible de se connecter a la base de donnees');

         // echapper les entrees utilisateurs pour eviter les attaques sql et xss
         $username= mysqli_real_escape_string($db,$_POST['username']);
         $password= mysqli_real_escape_string($db,$_POST['password']);

          // verifier des informations d'identification
             $query ="SELECT * FROM utilisateur WHERE
                      nom_utilisateur='$username' AND mot_de_passe='$password'";
            $result = mysqli_query($db, $query);

              if (mysqli_num_rows($result) == 1){

                // utilisateur authentifie, redirigez vers la page principale
                 header('Location: page_reservation.php');
              }else{

                //afficher un message d'erreur si l'authentification echoue

                    header('Location:login.php?erreur=1');
              }
      }

      if(isset($_GET['erreur'])) {
        $error=$_GET['erreur'];
         if($error==1 || $error==2){
                echo"<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
         }
     }
?>
