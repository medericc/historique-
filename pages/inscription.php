<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données du formulaire
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier si les champs requis sont remplis  
    if (empty($nom_utilisateur) || empty($mot_de_passe)) {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        // Connexion à la base de données
        require_once "../login/login.php"; // Assurez-vous d'avoir le bon chemin

        // Vérifier si le nom d'utilisateur existe déjà
        $query_check = "SELECT id FROM users WHERE nom_utilisateur = :nom_utilisateur";
        $statement_check = $pdo->prepare($query_check);
        $statement_check->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
        $statement_check->execute();

        if ($statement_check->rowCount() > 0) {
            $erreur = "Ce nom d'utilisateur existe déjà. Veuillez en choisir un autre.";
        } else {
            // Hacher le mot de passe
            $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            // Préparer la requête SQL pour insérer un nouvel utilisateur
            $query_insert = "INSERT INTO users (nom_utilisateur, mot_de_passe) VALUES (:nom_utilisateur, :mot_de_passe)";
            $statement_insert = $pdo->prepare($query_insert);
            $statement_insert->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
            $statement_insert->bindParam(':mot_de_passe', $mot_de_passe_hache, PDO::PARAM_STR);

            // Exécuter la requête
            if ($statement_insert->execute()) {
                // Rediriger vers la page de connexion après l'inscription réussie
                header("Location: connexion.php");
                exit();
            } else {
                $erreur = "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <?php if (isset($erreur)) { ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nom_utilisateur">Nom d'utilisateur :</label>
        <input type="text" name="nom_utilisateur" id="nom_utilisateur" required>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
