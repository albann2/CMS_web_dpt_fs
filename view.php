<?php
  session_start();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/view.css">
    <link rel="icon" type="image/png" sizes="16x16" href="./IMG/UY1.png">
    <title>Document</title>
    <style>
      #capture{ 
        border:1px solid grey;
        width:200px;
        height:150px;
        margin-top: 2%;
        overflow: hidden;
      }
    </style>
</head>
<body>
    <div class="principal">
        <div class="formu">
            <p><img src="./img/images-removebg-preview.png" alt="note" width="5%"></p>
            <h1>Article scientifique</h1>
            <form action="./articles.php">
                <?php
                    $server="localhost";
                    $pass="";
                    $login="root";
                    try{
                        $connexion=new PDO("mysql:host=$server;dbname=projet",$login,$pass);
                        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $id=$_SESSION['id'];
                        $request=$connexion -> prepare("SELECT * FROM `article` WHERE id='$id'");
                        $request -> execute();
                        $resultat=$request -> fetchall();
                        echo "
                        <div class='section2'>
                            <fieldset>
                                <legend>Informations personnelles</legend>
                                <div>
                                    <label for=''>Nom de l'editeur: </label>
                                    ".$resultat[0][1]."
                                </div>
                                <div>
                                    <label for=''>Titre : </label>
                                    ".$resultat[0][2]."
                                </div>
                            </fieldset>
                        </div>
                        <div class='section3'>
                            <fieldset>
                                <legend>Contenue</legend>
                                <div>
                                    ".$resultat[0][3]."
                                </div>
                            </fieldset>
                        </div>";
                        
                    }
                    catch(PDOException $e){
                        echo "Connexion failed";
                    }
                ?>
                <div class="val">
                    <button type="submit">Valider</button>
                </div>   
            </form>
        </div>
        <footer>&copy; 2022–2023 ICT4D.</footer>
    </div>
</body>
</html>