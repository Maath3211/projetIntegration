<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de mot de passe</title>
</head>
<body>
    <h1>Réinitialisation de mot de passe, {{ $fournisseur->entreprise }}!</h1>
    <p>
        Vous pouvez réinitialiser le mot de passe de votre compte avec <a href="{{'http://127.0.0.1:8000/reinitialisation/' . $fournisseur->codeReset }}" class="link-right">ce lien</a> 
    </p>
</body>
</html>