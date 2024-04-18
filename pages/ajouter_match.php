<?php
// Vérifier l'authentification de l'utilisateur
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Traiter les données du formulaire d'ajout si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de configuration de la base de données
    require_once "../login/login.php";

    // Récupérer les données du formulaire
    $saison = $_POST['saison'];
    $championnat = $_POST['championnat'];
    $adversaire = $_POST['adversaire'];
    $pts = $_POST['pts'];
    $rbd = $_POST['rbd'];
    $ast = $_POST['ast'];
    $stl = $_POST['stl'];
    $blk = $_POST['blk'];
    $p = $_POST['p'];
    $pat = $_POST['pat'];
    $troisP = $_POST['troisP'];
    $troisPA = $_POST['troisPA'];
    $unP = $_POST['unP'];
    $unPA = $_POST['unPA'];
    $to = $_POST['to'];
    $eff = $_POST['eff'];
    $min = $_POST['min'];

    // Préparer la requête SQL INSERT
    $query = "INSERT INTO donnees (SAISON, CHAMPIONNAT, ADVERSAIRE, PTS, RBD, AST, STL, BLK, P, PAT, `3P`, `3PA`, `1P`, `1PA`, `TO`, EFF, MIN) VALUES (:saison, :championnat, :adversaire, :pts, :rbd, :ast, :stl, :blk, :p, :pat, :trois_pts, :trois_pts_att, :un_pts, :un_pts_att, :to, :eff, :min)";
    $statement = $pdo->prepare($query);

    // Liaison des valeurs
    $statement->bindParam(':saison', $saison, PDO::PARAM_STR);
    $statement->bindParam(':championnat', $championnat, PDO::PARAM_STR);
    $statement->bindParam(':adversaire', $adversaire, PDO::PARAM_STR);
    $statement->bindParam(':pts', $pts, PDO::PARAM_INT);
    $statement->bindParam(':rbd', $rbd, PDO::PARAM_INT);
    $statement->bindParam(':ast', $ast, PDO::PARAM_INT);
    $statement->bindParam(':stl', $stl, PDO::PARAM_INT);
    $statement->bindParam(':blk', $blk, PDO::PARAM_INT);
    $statement->bindParam(':p', $p, PDO::PARAM_INT);
    $statement->bindParam(':pat', $pat, PDO::PARAM_INT);
    $statement->bindParam(':trois_pts', $troisP, PDO::PARAM_INT);
    $statement->bindParam(':trois_pts_att', $troisPA, PDO::PARAM_INT);
    $statement->bindParam(':un_pts', $unP, PDO::PARAM_INT);
    $statement->bindParam(':un_pts_att', $unPA, PDO::PARAM_INT);
    $statement->bindParam(':to', $to, PDO::PARAM_INT);
    $statement->bindParam(':eff', $eff, PDO::PARAM_INT);
    $statement->bindParam(':min', $min, PDO::PARAM_INT);

    // Exécution de la requête
    $statement->execute();

    // Rediriger l'utilisateur vers une page de confirmation ou une autre page après l'ajout des données
    header("Location: confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des données</title>
</head>
<body>
<h2>Ajouter des données</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="saison">Saison :</label>
    <input type="text" name="saison" id="saison" required>
    <label for="championnat">Championnat :</label>
    <input type="text" name="championnat" id="championnat" required>
    <label for="adversaire">Adversaire :</label>
    <input type="text" name="adversaire" id="adversaire" required>
    <label for="pts">Points :</label>
    <input type="number" name="pts" id="pts" required>
    <label for="rbd">Rebonds :</label>
    <input type="number" name="rbd" id="rbd" required>
    <label for="ast">Assists :</label>
    <input type="number" name="ast" id="ast" required>
    <label for="stl">Steals :</label>
    <input type="number" name="stl" id="stl" required>
    <label for="blk">Blocks :</label>
    <input type="number" name="blk" id="blk" required>
    <label for="p">P :</label>
    <input type="number" name="p" id="p" required>
    <label for="pat">PA Tirées :</label>
    <input type="number" name="pat" id="pat" required>
    <label for="troisP">3 Points :</label>
    <input type="number" name="troisP" id="troisP" required>
    <label for="troisPA">3 Points tentés :</label>
    <input type="number" name="troisPA" id="troisPA" required>
    <label for="unP">1 Point :</label>
    <input type="number" name="unP" id="unP" required>
    <label for="unPA">1 Point tentés :</label>
    <input type="number" name="unPA" id="unPA" required>
    <label for="to">Turnovers :</label>
    <input type="number" name="to" id="to" required>
    <label for="eff">EFF :</label>
    <input type="number" name="eff" id="eff" required>
    <label for="min">Minutes :</label>
    <input type="number" name="min" id="min" required>
    <input type="submit" value="Ajouter">
</form>

</body>
</html>
   