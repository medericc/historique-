console.log(3);

// Charger le contenu de l'en-tête
fetch('header.php')
 .then(response => response.text())
 .then(html => {
     document.getElementById('header').innerHTML = html;
 });

// Charger le contenu du pied de page
fetch('footer.php')
 .then(response => response.text())
 .then(html => {
     document.getElementById('footer').innerHTML = html;
 });
