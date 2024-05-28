<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface de Recherche</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h2>Recherche des acteurs</h2>
        <form action="#" method="post">
            <label for="searchInput">Recherchez par le critere de votre choix. :</label><br>
            <input type="text" id="searchInput" name="search" placeholder="Entrez ici...">
            <input type="submit" value="Rechercher">
        </form>
    <?php
    if(isset($_POST['search'])){
        $servername = '127.0.0.1';
        $username = 'root';
        $password = '';
        $dbname = 'edl_acteurs';
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connex réussie';
            $sth = $conn->prepare("SELECT * FROM ACTEURS WHERE NOM = :search OR PRENOMS = :search OR DATE_NAISSANCE=:search OR LIEU_NAISSANCE=:search OR EMAIL=:search OR DIPLOME=:search OR BANQUE=:search OR RIB=:search OR PDF_CIN=:search    ");

            //$sth = $conn->prepare("SELECT * FROM ACTEURS WHERE NOM = :search"); // Utiliser un paramètre nommé
            $sth->bindParam(':search', $_POST['search']); 
            // $sth->bindParam(':search', '%$_POST[\'search\']%'); 
            $sth->execute();
            $rowAll = $sth->fetchAll(); ?>
            <table>
                <tr>
                    <td>Nom</td>
                    <td>Prenoms</td>
                    <td>Date de naissance</td>
                    <td>Lieu de naissance</td>
                    <td>Email</td>
                    <td>Diplome</td>
                    <td>Banque</td>
                    <td>RIB</td>
                    <td>PDF CIN</td>
                <?php 
                foreach($rowAll as $donnees)
                {?>
                    <tr>
                        <td><?php echo $donnees['NOM'];?></td>
                        <td><?php echo $donnees['PRENOMS'];?></td>
                        <td><?php echo $donnees['DATE_NAISSANCE'];?></td>
                        <td><?php echo $donnees['LIEU_NAISSANCE'];?></td>
                        <td><?php echo $donnees['EMAIL'];?></td>
                        <td><?php echo $donnees['DIPLOME'];?></td>
                        <td><?php echo $donnees['BANQUE'];?></td>
                        <td><?php echo $donnees['RIB'];?></td>
                        <td><?php echo $donnees['PDF_CIN'];?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        }
        catch(PDOException $e){
            echo "Erreur : " . $e;
        } ?>
    <?php
    }
    else{?>

        <?php
            $servername = '127.0.0.1';
            $username = 'root';
            $password = '';
            $dbname = 'edl_acteurs';
            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'Connexion réussie';
                $sth = $conn->prepare("SELECT * FROM ACTEURS");
                $sth->execute();
                $rowAll = $sth->fetchAll();
                // $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                // echo '<pre>';
                // print_r($resultat);
                // echo '</pre>';
        ?>
                <table>
                    <tr>
                        <td>Nom</td>
                        <td>Prenoms</td>
                        <td>Date de naissance</td>
                        <td>Lieu de naissance</td>
                        <td>Email</td>
                        <td>Diplome</td>
                        <td>Banque</td>
                        <td>RIB</td>
                        <td>PDF CIN</td>
                    <?php 
                    foreach($rowAll as $donnees)
                    { ?>
                        <tr>
                            <td><?php echo $donnees['NOM'];?></td>
                            <td><?php echo $donnees['PRENOMS'];?></td>
                            <td><?php echo $donnees['DATE_NAISSANCE'];?></td>
                            <td><?php echo $donnees['LIEU_NAISSANCE'];?></td>
                            <td><?php echo $donnees['EMAIL'];?></td>
                            <td><?php echo $donnees['DIPLOME'];?></td>
                            <td><?php echo $donnees['BANQUE'];?></td>
                            <td><?php echo $donnees['RIB'];?></td>
                            <td><a href="http://localhost:8080/<?php echo $donnees['PDF_CIN'];?>"><?php echo $donnees['PDF_CIN'];?></a></td>
                        </tr>
                    <?php
                    } ?>
                </table>
            <?php
            }
            catch(PDOException $e){
                echo "Erreur : " . $e;
            } ?>

<?php   } ?>
<a href="interface.php"><button>S'enregistrer</button></a>
</body>
</html>