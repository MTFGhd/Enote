<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .info-box {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #4F46E5;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            color: #6b7280;
            font-size: 12px;
        }
        strong {
            color: #4F46E5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bienvenue sur E-Note</h1>
    </div>
    
    <div class="content">
        <p>Bonjour <strong>{{ $user->name }}</strong>,</p>
        
        <p>Votre compte a été créé avec succès sur la plateforme E-Note.</p>
        
        <div class="info-box">
            <h3 style="margin-top: 0;">Informations de connexion :</h3>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            @if($password)
            <p><strong>Mot de passe :</strong> {{ $password }}</p>
            <p style="color: #dc2626; font-size: 14px;">
                ⚠️ Pour des raisons de sécurité, veuillez changer votre mot de passe lors de votre première connexion.
            </p>
            @endif
            <p><strong>Rôle :</strong> {{ ucfirst($user->role ?? 'Utilisateur') }}</p>
            @if($user->CodeE)
            <p><strong>Code Enseignant :</strong> {{ $user->CodeE }}</p>
            @endif
        </div>
        
        <p>Vous pouvez maintenant vous connecter à la plateforme et commencer à utiliser ses fonctionnalités.</p>
        
        <p>Si vous avez des questions ou rencontrez des problèmes, n'hésitez pas à contacter l'administration.</p>
        
        <p>Cordialement,<br>
        <strong>L'équipe E-Note</strong></p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        <p>&copy; {{ date('Y') }} E-Note. Tous droits réservés.</p>
    </div>
</body>
</html>
