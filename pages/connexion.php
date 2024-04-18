<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
// Vérifie si l'utilisateur est déjà connecté, le redirige s'il est connecté
if (isset($_SESSION['id_utilisateur'])) {
    header("Location: club.php");
    exit();
}

// Définir une variable pour stocker le message de succès de la connexion
$connexion_reussie = false;

// Vérifie si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../login/login.php"; // Fichier contenant les informations de connexion à la base de données

    // Récupère les valeurs du formulaire
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Prépare et exécute la requête SQL
    $query = "SELECT id, mot_de_passe FROM users WHERE nom_utilisateur = :nom_utilisateur";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC); 

    // Vérifie si l'utilisateur existe dans la base de données et si le mot de passe correspond
    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        // L'authentification est réussie
        $_SESSION['id_utilisateur'] = $user['id']; // Stocke l'ID de l'utilisateur dans la session
        $connexion_reussie = true;
        header("Location: all.php"); // Redirige vers la page de tableau de bord après connexion
        exit();
    } else {
        $erreur = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../sass/styles.css">

    <script>
    <?php if ($connexion_reussie) { ?>
        // Afficher une alerte si la connexion est réussie
        window.onload = function() {
            alert("Connexion réussie !");
        };
    <?php } ?>
    </script>
</head>
<body>
    <h2 class="loginh2">Connexion</h2>
    <?php if (isset($erreur)) { ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php } ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="coContainer">  <label for="nom_utilisateur">Nom d'utilisateur :</label>
        <input type="text" name="nom_utilisateur" id="nom_utilisateur" required>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>
        <input class="seco" type="submit" value="Se connecter">
    </form> <a class="seco" href="inscription.php">S'inscrire</a> </div>
</body>
</html>
