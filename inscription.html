<?php
require 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    // Vérification de l'unicité de l'email
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $message = "L'email est déjà utilisé.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $mot_de_passe]);
        $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form method="POST">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
            <?php if (strpos($message, "réussie") !== false): ?>
                <p class="message"><a href="connexion.php">Cliquez ici pour vous connecter</a></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>