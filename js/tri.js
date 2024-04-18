// Tableau pour suivre l'état de tri pour chaque colonne
var sortStates = [];

function sortByColumn(columnIndex) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("myTable");
    switching = true;

    // Vérifie si l'état de tri de la colonne est défini
    if (!sortStates[columnIndex]) {
        sortStates[columnIndex] = 'desc'; // Si non défini, initialisation à 'desc' (tri décroissant)
    } else {
        sortStates[columnIndex] = (sortStates[columnIndex] === 'asc') ? 'desc' : 'asc'; // Inverse l'état de tri
    }

    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[columnIndex];
            y = rows[i + 1].getElementsByTagName("td")[columnIndex];
            if (sortStates[columnIndex] === 'asc') {
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            } else {
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}
