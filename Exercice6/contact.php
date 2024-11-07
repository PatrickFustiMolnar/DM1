<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et validation des données du formulaire
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    if (empty($name) || empty($email) || empty($message)) {
        echo "❌ Tous les champs sont requis.";
    } else {
        // Affichage des données sur la page
        echo "<h1>Merci pour votre message, $name !</h1>";
        echo "<p><strong>Email :</strong> $email</p>";
        echo "<p><strong>Message :</strong> $message</p>";

        // Fonction pour envoyer l'email avec un try-catch
        try {
            if (envoyerEmail($name, $email, $message)) {
                echo "<p>✅ Votre message a été envoyé avec succès par email.</p>";
            } else {
                throw new Exception("L'envoi de l'email a échoué.");
            }
        } catch (Exception $e) {
            echo "<p>❌ Erreur : " . $e->getMessage() . "</p>";
        }
    }
}

/**
 * Fonction pour envoyer un email
 * @param string $name Nom de l'expéditeur
 * @param string $email Adresse email de l'expéditeur
 * @param string $message Message envoyé
 * @return bool Retourne true si l'email est envoyé, false sinon
 */
function envoyerEmail($name, $email, $message) {
    $to = "your-email@example.com";
    $subject = "Nouveau message de contact de $name";
    $body = "Nom: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: noreply@yourwebsite.com";

    return mail($to, $subject, $body, $headers);
}
?>