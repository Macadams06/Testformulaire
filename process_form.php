<?php

// Vérifie si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Adresse e-mail du destinataire (Damien)
    $destinataire = "damien.tsn@gmail.com";

    // Sujet de l'e-mail
    $sujet = "Nouvelle inscription via le formulaire du site";

    // Récupérer les données du formulaire
    $nom = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Non renseigné';
    $email_expediteur = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'Non renseigné';
    $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : 'Non renseigné';
    // Les mots de passe ne devraient pas être envoyés par e-mail en clair pour des raisons de sécurité !
    // Si vous traitez des inscriptions, vous devriez hacher et stocker les mots de passe dans une base de données.
    // Pour cet exemple, nous n'inclurons pas les mots de passe dans l'e-mail.

    // Construire le corps de l'e-mail
    $message_email = "Bonjour Damien,\n\n";
    $message_email .= "Une nouvelle personne s'est inscrite sur votre site :\n\n";
    $message_email .= "Nom : " . $nom . "\n";
    $message_email .= "Email : " . $email_expediteur . "\n";
    $message_email .= "Téléphone : " . $telephone . "\n\n";
    $message_email .= "Ceci est un e-mail automatique généré par le formulaire d'inscription.";

    // En-têtes de l'e-mail pour s'assurer qu'il est bien formaté et peut être répondu
    $headers = "From: Formulaire Inscription <no-reply@damien.com>\r\n"; // Remplacez votresite.com par votre nom de domaine
    $headers .= "Reply-To: " . $email_expediteur . "\r\n"; // Permet de répondre directement à l'utilisateur
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Envoi de l'e-mail
    if (mail($destinataire, $sujet, $message_email, $headers)) {
        // Redirection après l'envoi réussi pour éviter le renvoi du formulaire
        // Vous pouvez rediriger vers une page de confirmation
        header("Location: confirmation.html");
        exit; // Important pour arrêter l'exécution du script après la redirection
    } else {
        // En cas d'échec de l'envoi
        echo "Désolé, une erreur est survenue lors de l'envoi de votre inscription. Veuillez réessayer plus tard.";
    }

} else {
    // Si le script est accédé directement sans soumission de formulaire POST
    echo "Ce script ne peut être accédé que via la soumission d'un formulaire.";
}

?>