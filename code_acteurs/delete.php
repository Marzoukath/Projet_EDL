<?php
include('connex.php');
// echo 'qwertyu';
if (isset($_GET["id_acteur"]) AND is_numeric($_GET["id_acteur"]))
{
    $id = htmlentities($_GET["id_acteur"]);
    $requete = "DELETE FROM ACTEURS WHERE id = ".$id.";";
    // echo $requete;
    $conn -> exec($requete);
    header("Location: interface_admin.php");
}