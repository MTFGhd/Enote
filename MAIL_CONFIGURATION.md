# Configuration de l'envoi automatique de mails

## Fonctionnalités implémentées

### 1. Envoi automatique lors de la création d'utilisateur
Un email de bienvenue est automatiquement envoyé à chaque nouvel utilisateur créé, contenant :
- Son nom d'utilisateur
- Son email de connexion
- Son mot de passe initial
- Son rôle
- Un rappel de changer le mot de passe lors de la première connexion

### 2. Configuration actuelle (Développement)
Le projet est actuellement configuré avec `MAIL_MAILER=log` dans le fichier `.env`, ce qui signifie que les emails sont enregistrés dans les fichiers logs au lieu d'être réellement envoyés.

Vous pouvez consulter les emails générés dans : `storage/logs/laravel.log`

## Configuration pour la production

Pour envoyer de vrais emails en production, vous devez configurer un serveur SMTP dans le fichier `.env` :

### Option 1 : Serveur SMTP classique

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@example.com
MAIL_PASSWORD=votre-mot-de-passe
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="E-Note"
```

### Option 2 : Gmail (pour tests uniquement)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-mot-de-passe-application
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=votre-email@gmail.com
MAIL_FROM_NAME="E-Note"
```

**Note :** Pour Gmail, vous devez activer l'authentification à deux facteurs et générer un "mot de passe d'application".

### Option 3 : Mailtrap (pour tests)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre-username-mailtrap
MAIL_PASSWORD=votre-password-mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="E-Note"
```

### Option 4 : Services professionnels

Pour la production, il est recommandé d'utiliser des services professionnels comme :
- **SendGrid**
- **Mailgun**
- **Amazon SES**
- **Postmark**

## Test de l'envoi de mail

Pour tester l'envoi de mail, créez simplement un nouvel utilisateur via l'interface d'administration :

1. Connectez-vous en tant qu'administrateur
2. Allez dans la section "Utilisateurs"
3. Cliquez sur "Créer un utilisateur"
4. Remplissez le formulaire et soumettez

L'email sera automatiquement envoyé (ou enregistré dans les logs si vous utilisez `MAIL_MAILER=log`).

## Fichiers créés/modifiés

### Nouveaux fichiers :
- `app/Mail/UserCreatedMail.php` - Classe Mailable pour l'email de bienvenue
- `resources/views/emails/user-created.blade.php` - Template HTML de l'email

### Fichiers modifiés :
- `app/Models/User.php` - Ajout de l'événement `created` pour l'envoi automatique
- `app/Http/Controllers/UsersController.php` - Modification de la méthode `store` pour gérer le mot de passe en clair

## Personnalisation

### Modifier le contenu de l'email
Éditez le fichier `resources/views/emails/user-created.blade.php` pour personnaliser le design et le contenu de l'email.

### Modifier l'objet de l'email
Éditez la méthode `envelope()` dans `app/Mail/UserCreatedMail.php` :

```php
public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Votre nouvel objet personnalisé',
    );
}
```

## Sécurité

⚠️ **Important :** Le mot de passe est envoyé en clair par email. Assurez-vous que :
1. Vos emails sont envoyés via une connexion sécurisée (TLS/SSL)
2. Les utilisateurs sont invités à changer leur mot de passe lors de la première connexion
3. Vous utilisez une politique de mots de passe forts
