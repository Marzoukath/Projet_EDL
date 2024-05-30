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
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $lieu_naissance = $_POST['lieu_naissance'];

        if (!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/', $nom)) {
            $errors['nom'] = 'Le nom doit contenir uniquement des caractères alphabétiques.';
        }

        if (!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/', $prenom)) {
            $errors['prenom'] = 'Le prénom doit contenir uniquement des caractères alphabétiques.';
        }

        if (!preg_match('/^[a-zA-ZÀ-ÿ\s]+$/', $lieu_naissance)) {
            $errors['lieu_naissance'] = 'Le lieu de naissance doit contenir uniquement des caractères alphabétiques.';
        }

        if (empty($errors)) {
            $uploaddir = 'storage/';
            $uploadfile = $uploaddir . 'CNI_' . $_POST['rib'] . '.pdf';
            if (move_uploaded_file($_FILES['pdf_cin']['tmp_name'], $uploadfile)) {
                $servername = '127.0.0.1';
                $username = 'root';
                $password = '';
                $dbname = 'edl_acteurs';
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sth = $conn->prepare("
                    INSERT INTO ACTEURS(NOM, PRENOMS, DATE_NAISSANCE, LIEU_NAISSANCE, EMAIL, DIPLOME, BANQUE, RIB, PDF_CIN)
                    VALUES(:nm, :prnm, :date, :lieu, :email, :dipl, :bque, :rib, :pdf_cin)");
                    $sth->bindParam(':nm', $_POST['nom']);
                    $sth->bindParam(':prnm', $_POST['prenom']);
                    $sth->bindParam(':date', $_POST['date_naissance']);
                    $sth->bindParam(':lieu', $_POST['lieu_naissance']);
                    $sth->bindParam(':email', $_POST['email']);
                    $sth->bindParam(':dipl', $_POST['diplome']);
                    $sth->bindParam(':bque', $_POST['banque']);
                    $sth->bindParam(':rib', $_POST['rib']);
                    $sth->bindParam(':pdf_cin', $uploadfile);
                    $sth->execute();
                    $conn = null;
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            } else {
                echo "Possible file upload attack!\n";
            }
        }
    } ?>

   
    <form action="interface_user.php" method="post" enctype="multipart/form-data">
    <h2 style="text-align: center;">Formulaire d'enregistrement</h2>
    <hr>
    
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required pattern="[a-zA-ZÀ-ÿ\s]+" title="Caractères alphabétiques uniquement" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">
        <?php if (isset($errors['nom'])) echo '<p style="color: red;">' . $errors['nom'] . '</p>'; ?>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required pattern="[a-zA-ZÀ-ÿ\s]+" title="Caractères alphabétiques uniquement" value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>">
        <?php if (isset($errors['prenom'])) echo '<p style="color: red;">' . $errors['prenom'] . '</p>'; ?>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required value="<?php echo isset($_POST['date_naissance']) ? htmlspecialchars($_POST['date_naissance']) : ''; ?>">

        <label for="lieu_naissance">Lieu de naissance :</label>
        <input type="text" id="lieu_naissance" name="lieu_naissance" required pattern="[a-zA-ZÀ-ÿ\s]+" title="Caractères alphabétiques uniquement" value="<?php echo isset($_POST['lieu_naissance']) ? htmlspecialchars($_POST['lieu_naissance']) : ''; ?>">
        <?php if (isset($errors['lieu_naissance'])) echo '<p style="color: red;">' . $errors['lieu_naissance'] . '</p>'; ?>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

        <label for="diplome">Diplôme :</label>
        <input type="text" id="diplome" name="diplome" required value="<?php echo isset($_POST['diplome']) ? htmlspecialchars($_POST['diplome']) : ''; ?>">

        <label for="banque">Banque :</label>
        <select id="banque" name="banque" required>
            <option value="">Sélectionnez une banque</option>
            <option value="Bank of Africa" <?php echo (isset($_POST['banque']) && $_POST['banque'] == 'Bank of Africa') ? 'selected' : ''; ?>>Bank of Africa</option>
            <option value="Ecobank" <?php echo (isset($_POST['banque']) && $_POST['banque'] == 'Ecobank') ? 'selected' : ''; ?>>Ecobank</option>
            <option value="Société Générale Bénin" <?php echo (isset($_POST['banque']) && $_POST['banque'] == 'Société Générale Bénin') ? 'selected' : ''; ?>>Société Générale Bénin</option>
        </select>

        <label for="rib">RIB :</label>
        <input type="text" id="rib" name="rib" required value="<?php echo isset($_POST['rib']) ? htmlspecialchars($_POST['rib']) : ''; ?>">

        <label for="pdf_cin">PDF CIN :</label>
        <input type="file" id="pdf_cin" name="pdf_cin" accept="application/pdf" required>

        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
