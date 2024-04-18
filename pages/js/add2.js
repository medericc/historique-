// Charger le contenu de l'en-tête
fetch('../header.php') // Remontez d'un niveau pour accéder à header.php
 .then(response => response.text())
 .then(html => {
     document.getElementById('header').innerHTML = html;
 });

// Charger le contenu du pied de page
fetch('../footer.php') // Remontez d'un niveau pour accéder à footer.php
 .then(response => response.text())
 .then(html => {
     document.getElementById('footer').innerHTML = html;
 });
