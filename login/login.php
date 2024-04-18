<?php
try {
    // Connexion à MySQL
    $pdo = new PDO('mysql:host=localhost;dbname=sport;charset=utf8', 'root', '');
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message et arrêter le script
    die('Erreur : ' . $e->getMessage());
}

// Si la connexion réussit, on peut continuer

// Récupérer tout le contenu de la table donnees
$sql = 'SELECT * FROM donnees';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$donnees = $stmt->fetchAll();
?>
