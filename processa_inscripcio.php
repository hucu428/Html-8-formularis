<?php
// Comprova si s'ha enviat el formulari
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recollim les dades del formulari
    $nom = htmlspecialchars($_POST['nom']);
    $contrasenya = htmlspecialchars($_POST['contrasenya']);
    $plataforma = $_POST['plataforma'] ?? 'No especificada';
    $generes = $_POST['genere'] ?? [];
    $torneig_id = $_POST['torneig_id'];

    // Gestió de fitxer pujat
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $nom_fitxer = basename($_FILES['avatar']['name']);
        $ruta_desti = "uploads/" . $nom_fitxer;

        // Crea la carpeta si no existeix
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        // Desa el fitxer pujat
        move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta_desti);
        $missatge_fitxer = "Fitxer pujat correctament: $nom_fitxer";
    } else {
        $missatge_fitxer = "No s'ha pujat cap fitxer.";
    }

    // Mostra les dades rebudes
    echo "<h1>Inscripció rebuda!</h1>";
    echo "<p><strong>Nom:</strong> $nom</p>";
    echo "<p><strong>Plataforma:</strong> $plataforma</p>";
    echo "<p><strong>Gèneres:</strong> " . implode(", ", $generes) . "</p>";
    echo "<p><strong>Torneig ID:</strong> $torneig_id</p>";
    echo "<p><strong>$missatge_fitxer</strong></p>";
} else {
    echo "<p>Error: el formulari no s'ha enviat correctament.</p>";
}
?>
