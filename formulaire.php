<?php
$nom = $_POST['nom'];
$prenom = $_POST["prenom"];
$message= $_POST["message"];
$telephone = $_POST["telephone"];
$mail = $_POST["mail"];


if (!empty($post["nom"])
    &&!empty($post["prenom"])
    && !empty($post["message"])
    &&!empty($post["mail"])
    &&!empty($post["telephone"])
    ){
    if (mb_strlen($_POST["nom"]) <=30
        && preg_match("~^[A-Za-z '-]+$~i", $_POST[$nom])
        && mb_strlen($_POST[$message] >= 3 )
        && filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $message = $_POST["message"];
        $mail = $_POST["mail"];
        $telephone = $_POST["telephone"];

        try {
            $dbco = new PDO("mysql:host=localhost;dbname=messageSitePerso", root, root);

            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $dbco->prepare("
            INSERT INTO form(nom, prenom, message, mail, telephone)
            VALUES(:nom, :prenom, :message, :mail, :telephone)");
            $sth->bindParam(':nom', $nom);
            $sth->bindParam(':prenom', $prenom);
            $sth->bindParam(':message', $message);
            $sth->bindParam(':mail', $mail);
            $sth->bindParam(':telephone', $telephone);
            $sth->execute();

            header("Location:form-merci.php");
        }

    catch(PDOException $e){
        echo'Impossible de traiter les données. Veuillez recommencer';
    }
}}

