<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le formulaire a été soumis avec succès
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Chemin temporaire du fichier uploadé
        $cheminTemporaire = $_FILES['photo']['tmp_name'];

        // Déplacer le fichier vers le dossier de destination
        $dossierDestination = 'C:\wamp64\www\pfe\secretairy';
        $nomFichier = $_FILES['photo']['name'];
        $cheminDestination = $dossierDestination . $nomFichier;

        if (move_uploaded_file($cheminTemporaire, $cheminDestination)) {
            // Le fichier a été déplacé avec succès

            // Enregistrer le chemin dans la base de données
            // Connexion à la base de données...

            $cheminPhoto = $cheminDestination;

            // Requête d'insertion dans la base de données...
        } else {
            echo "Erreur lors du déplacement du fichier.";
        }
    } else {
        echo "Erreur lors de l'envoi du fichier.";
    }
}
?>

<!-- Formulaire HTML -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="photo">
    <input type="submit" value="Envoyer">
</form>
