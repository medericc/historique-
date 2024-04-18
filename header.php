<header>
    <nav>
        <ul>
            <li><a href="/sport/index.php" id="lien">Accueil</a></li>
            <li><a href="/sport/pages/clubs.php">CLubs</a></li>
            <li><a href="/sport/pages/selection.php">Sélection</a></li>
            <li><a href="/sport/pages/all.php">Ligue</a></li>
            <?php
            // Vérifie si l'utilisateur est connecté
            session_start();
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<a id="loginlgout" href="/sport/pages/logout.php" class="log">Logout</a>';
            } else {
                echo '<a id="loginlgout" href="/sport/pages/connexion.php" class="log">Login</a>';
            }
            ?>
        </ul>
    </nav>
</header>
