<?php
$filename = "utilisateurs.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUser = [
        "nom" => $_POST["nom"],
        "prenom" => $_POST["prenom"],
        "email" => $_POST["email"]
    ];
    
    $users = json_decode(file_get_contents($filename), true);
    $users[] = $newUser;
    file_put_contents($filename, json_encode($users));
}


$users = json_decode(file_get_contents($filename), true);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    // Supprimer l'utilisateur
    $users = json_decode(file_get_contents($filename), true);
    $updatedUsers = array_filter($users, function($user) use ($email) {
        return $user['email'] !== $email;
    });
    file_put_contents($filename, json_encode(array_values($updatedUsers)));
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user["nom"]) ?></td>
                <td><?= htmlspecialchars($user["prenom"]) ?></td>
                <td><?= htmlspecialchars($user["email"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter un utilisateur</h2>
    <form method="post">
        <label>Nom : <input type="text" name="nom" required></label><br>
        <label>Prénom : <input type="text" name="prenom" required></label><br>
        <label>Email : <input type="email" name="email" required></label><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>