<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface de Recherche</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f7f7f7;
        }

        h2 {
    color: #000000; 
    font-size: 2em; 
}


        form {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"] {
            width: 300px;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container a button {
            padding: 10px 20px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container a button:hover {
            background-color: #007B9A;
        }

        .title {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        a.edit {
            color: #FFC107;
        }
        a.delete {
            color: #E34724;
        }
        
    </style>
    
</head>
<body>
    <h2>RECHERCHE DES ACTEURS</h2>
    <form action="#" method="post">
        <label for="searchInput">Recherchez par le critère de votre choix :</label><br>
        <input type="text" id="searchInput" name="search" placeholder="Entrez ici...">
        <input type="submit" value="Rechercher">
    </form>
    <?php
    if (isset($_POST['search'])) {
        $servername = '127.0.0.1';
        $username = 'root';
        $password = '';
        $dbname = 'edl_acteurs';

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 'Connexion réussie';

            // Prepare the SQL statement with named parameters
            $sth = $conn->prepare("SELECT * FROM ACTEURS WHERE 
                NOM LIKE :search OR 
                PRENOMS LIKE :search OR 
                DATE_NAISSANCE LIKE :search OR 
                LIEU_NAISSANCE LIKE :search OR 
                EMAIL LIKE :search OR 
                DIPLOME LIKE :search OR 
                BANQUE LIKE :search OR 
                RIB LIKE :search OR 
                PDF_CIN LIKE :search");

            
            $searchTerm = "%" . $_POST['search'] . "%";
            $sth->bindParam(':search', $searchTerm, PDO::PARAM_STR);

            // Execute the query
            $sth->execute();

            // Fetch the results
            $rowAll = $sth->fetchAll(PDO::FETCH_ASSOC); ?>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prenoms</th>
                    <th>Date de naissance</th>
                    <th>Lieu de naissance</th>
                    <th>Email</th>
                    <th>Diplome</th>
                    <th>Banque</th>
                    <th>RIB(pdf)</th>
                    <th>PDF CIN</th>
                    <th>Actions</th>
                </tr>
                <?php 
                foreach ($rowAll as $donnees) { ?>
                    <tr>
                        <td><?php echo $donnees['NOM']; ?></td>
                        <td><?php echo $donnees['PRENOMS']; ?></td>
                        <td><?php echo $donnees['DATE_NAISSANCE']; ?></td>
                        <td><?php echo $donnees['LIEU_NAISSANCE']; ?></td>
                        <td><?php echo $donnees['EMAIL']; ?></td>
                        <td><?php echo $donnees['DIPLOME']; ?></td>
                        <td><?php echo $donnees['BANQUE']; ?></td>
                        <td><a href="http://localhost:8080/<?php echo $donnees['PDF_RIB']; ?>"><?php echo $donnees['RIB']; ?></a></td>
                        <td><a href="http://localhost:8080/<?php echo $donnees['PDF_CIN']; ?>">Voir</a></td>
                        <td>
                            <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php
                } ?>
            </table>
        <?php
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        } ?>
    <?php
    } else {
        $servername = '127.0.0.1';
        $username = 'root';
        $password = '';
        $dbname = 'edl_acteurs';

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 'Connexion réussie';
            $sth = $conn->prepare("SELECT * FROM ACTEURS");
            $sth->execute();
            $rowAll = $sth->fetchAll(PDO::FETCH_ASSOC);
        ?>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prenoms</th>
                    <th>Date de naissance</th>
                    <th>Lieu de naissance</th>
                    <th>Email</th>
                    <th>Diplome</th>
                    <th>Banque</th>
                    <th>RIB(pdf)</th>
                    <th>PDF CIN</th>
                    <th>Actions</th>
                </tr>
                <?php 
                foreach ($rowAll as $donnees) { ?>
                    <tr>
                        <td><?php echo $donnees['NOM']; ?></td>
                        <td><?php echo $donnees['PRENOMS']; ?></td>
                        <td><?php echo $donnees['DATE_NAISSANCE']; ?></td>
                        <td><?php echo $donnees['LIEU_NAISSANCE']; ?></td>
                        <td><?php echo $donnees['EMAIL']; ?></td>
                        <td><?php echo $donnees['DIPLOME']; ?></td>
                        <td><?php echo $donnees['BANQUE']; ?></td>
                        <td><a href="http://localhost:8080/<?php echo $donnees['PDF_RIB']; ?>"><?php echo $donnees['RIB']; ?></a></td>
                        <td><a href="http://localhost:8080/<?php echo $donnees['PDF_CIN']; ?>">Voir</a></td>
                        <td>
                            <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="delete.php?id_acteur=<?php echo $donnees['id']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php
                } ?>
            </table>
        <?php
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } ?>
<div class="button-container">
    <a href="interface_user.php"><button>Enregistrer Acteurs</button></a>
</div>
</body>
</html>
