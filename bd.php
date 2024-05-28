<!DOCTYPE html>
<html>
    <head>
        <title>Cours PHP / MySQL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <h1>Bases de données MySQL</h1>  
        <?php
            $servername = '127.0.0.1';
            $username = 'root';
            $password = '';
            $dbname = 'edl_acteurs';
            
            //On essaie de se connecter
            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                //On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'Connexion réussie';
            }
            
            
            catch(PDOException $e){
              echo "Erreur : " . $e;
            }
        ?>
    </body>
</html>