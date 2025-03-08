<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

// Ajouter un étudiant
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare("INSERT INTO etudiants (utilisateur_id, prenom, nom, age) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $prenom, $nom, $age]);
}

// Modifier un étudiant
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare("UPDATE etudiants SET prenom = ?, nom = ?, age = ? WHERE id = ?");
    $stmt->execute([$prenom, $nom, $age, $id]);
    header("Location: gestion_etudiants.php"); // Redirection après modification
    exit();
}

// Supprimer un étudiant
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: gestion_etudiants.php"); // Redirection après suppression
    exit();
}

// Récupérer les étudiants
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE utilisateur_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$etudiants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Étudiants</h1>

        <h2>Ajouter un Étudiant</h2>
        <form method="POST">
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="number" name="age" placeholder="Âge" required>
            <button type="submit" name="ajouter">Ajouter Étudiant</button>
        </form>

        <h2>Liste des Étudiants</h2>
        <table>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Âge</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <form method="POST"> <!-- Formulaire pour modifier -->
                        <td><input type="text" name="prenom" value="<?php echo htmlspecialchars($etudiant['prenom']); ?>" required></td>
                        <td><input type="text" name="nom" value="<?php echo htmlspecialchars($etudiant['nom']); ?>" required></td>
                        <td><input type="number" name="age" value="<?php echo htmlspecialchars($etudiant['age']); ?>" required></td>
                        <td>
                            <button type="submit" name="modifier">Modifier</button>
                            <a href="?supprimer=<?php echo $etudiant['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</a>
                            <input type="hidden" name="id" value="<?php echo $etudiant['id']; ?>"> <!-- Champ caché pour l'ID -->
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>