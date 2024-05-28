<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire</title>
        <link rel="stylesheet" href="form.css">
    </head>
    <body>
        <?php
            if (isset($_POST['nom'])) {
                // File Management ######################################################################
                $uploaddir = 'storage/';
                $uploadfile = $uploaddir . 'CNI_' . $_POST['rib'] . '.pdf';
                // $uploadfile = $uploaddir . 'CNI_' . $_POST['nom'] . basename($_FILES['pdf_cin']['name']);
                if (move_uploaded_file($_FILES['pdf_cin']['tmp_name'], $uploadfile)) {
                    echo "File is valid, and was successfully uploaded.\n";
                    $servername = '127.0.0.1';
                    $username = 'root';
                    $password = '';
                    $dbname = 'edl_acteurs';
                    try{
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        echo 'Connexion réussie';
                        $sth = $conn->prepare("
                        INSERT INTO ACTEURS(NOM, PRENOMS, DATE_NAISSANCE, LIEU_NAISSANCE, EMAIL, DIPLOME, BANQUE, RIB, PDF_CIN)
                        VALUES(:nm, :prnm, :date, :lieu, :email, :dipl, :bque, :rib, :pdf_cin)");
                        $sth->bindParam(':nm',$_POST['nom']);
                        echo 'nom';
                        $sth->bindParam(':prnm',$_POST['prenom']);
                        echo 'prenom';
                        $sth->bindParam(':date',$_POST['date_naissance']);
                        echo 'date_naissance';
                        $sth->bindParam(':lieu',$_POST['lieu_naissance']);
                        echo 'lieu_naissance';
                        $sth->bindParam(':email',$_POST['email']);
                        echo 'email';
                        $sth->bindParam(':dipl',$_POST['diplome']);
                        echo 'diplome';
                        $sth->bindParam(':bque',$_POST['banque']);
                        echo 'banque';
                        $sth->bindParam(':rib',$_POST['rib']);
                        echo 'rib';
                        $sth->bindParam(':pdf_cin',$uploadfile);
                        // echo 'file';
                        // $sth->bindParam(':pdf_cin',$_POST['pdf_cin']);
                        $sth->execute();
                        echo 'execute';
                        // if ($conn->query($sth) === TRUE) {
                        //     echo "New record created successfully";
                        //   } else {
                        //     echo "Error: " . $sth . "<br>" . $conn->error;
                        //   }
                        
                        $conn->close();
                        echo 'qwertyu';
                        //On renvoie l'utilisateur vers la page de remerciement
                        // header("Location:form-merci.html");

                    }
                    catch(PDOException $e){
                        echo "Erreur : " . $e;
                    }

                } else {
                    echo "Possible file upload attack!\n";
                }

                // // ################# UNCOMMENT IF WANT TO KNOW SOME DETAILS ... ###########
                // echo 'Here is some more debugging info:';
                // print_r($_FILES);
                // // ######################################################################

                // print "</pre>";
                // // ######################################################################
                // print_r($_POST);
                

            }
            else { ?>
                <h2 style="text-align: center;">A remplir</h2>
                <form action="interface.php" method="post" enctype="multipart/form-data">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                    
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>
                    
                    <label for="date_naissance">Date de naissance :</label>
                    <input type="date" id="date_naissance" name="date_naissance" required>
                    
                    <label for="lieu_naissance">Lieu de naissance :</label>
                    <input type="text" id="lieu_naissance" name="lieu_naissance" required>
                    
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="diplome">Diplôme :</label>
                    <input type="text" id="diplome" name="diplome" required>
                    
                    <label for="banque">Banque :</label>
                    <select id="banque" name="banque" required>
                        <option value="">Sélectionnez une banque</option>
                        <option value="Bank of Africa">Bank of Africa</option>
                        <option value="Ecobank">Ecobank</option>
                        <option value="Société Générale Bénin">Société Générale Bénin</option>
                        <!-- Ajoutez d'autres options pour les banques disponibles au Bénin -->
                    </select>
                    
                    <label for="rib">RIB :</label>
                    <input type="text" id="rib" name="rib" required>
                    
                    <label for="pdf_cin">PDF CIN :</label>
                    <input type="file" id="pdf_cin" name="pdf_cin" accept="application/pdf" required>
                    
                    <input type="submit" value="Enregistrer">
                
                </form>
        <?php   }?>
        
        
    </body>
</html>
