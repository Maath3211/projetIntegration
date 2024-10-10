<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre inscription</title>
    <link rel="stylesheet" href="{{ asset('css/emailFournisseur.css') }}">
</head>
<body>
    <h1>Confirmation de votre inscription</h1>
    <p>Bonjour {{ $fournisseur->entreprise }},</p>
    <p>
        Nous vous remercions pour votre inscription et la soumission de vos informations. 
        Nous avons bien reçu votre demande et elle est actuellement en cours de traitement.
    </p>
    <p>
        Si vous souhaitez modifier certaines informations, n'hésitez pas à vous connecter sur le portail fourinisseur</a>.
    </p>
    <p>
        Si vous avez des questions, n'hésitez pas à nous contacter à tout moment à l'adresse suivante : <a href="https://www.v3r.net/">V3R</a>.
    </p>
    <p>
        Merci encore pour votre confiance. Nous vous contacterons sous peu avec plus de détails.
    </p>

    <p>
        Cordialement,<br>
        L'équipe de support technique<br>
        Ville de Trois-Rivières
    </p>
</body>
</html>
