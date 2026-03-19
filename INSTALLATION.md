# Guide d'Installation - Application de Gestion de Contacts

## Étapes d'installation détaillées

### 1. Prérequis

Assurez-vous d'avoir installé :
- **XAMPP** : Pour MySQL et Apache
- **PHP 8.2+** : Vérifiez avec `php -v`
- **Composer** : Gestionnaire de dépendances PHP
- **Node.js et NPM** : Pour compiler les assets frontend

### 2. Configuration de XAMPP

1. Démarrez **XAMPP Control Panel**
2. Démarrez les services **Apache** et **MySQL**
3. Ouvrez **phpMyAdmin** : `http://localhost/phpmyadmin`
4. Créez une nouvelle base de données nommée `todo_contacts`

### 3. Configuration du projet

#### Copier le fichier d'environnement
```bash
copy .env.example .env
```

#### Modifier le fichier .env
Ouvrez `.env` et configurez :

```env
APP_NAME="Gestion Contacts"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_contacts
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Installation des dépendances

#### Installer les packages PHP
```bash
composer install
```

#### Installer les packages JavaScript
```bash
npm install
```

### 5. Configuration de Laravel

#### Générer la clé d'application
```bash
php artisan key:generate
```

#### Créer le lien de stockage
```bash
php artisan storage:link
```

#### Exécuter les migrations
```bash
php artisan migrate
```

Vous devriez voir :
```
Migration table created successfully.
Migrating: 0001_01_01_000000_create_users_table
Migrated:  0001_01_01_000000_create_users_table
Migrating: 0001_01_01_000001_create_cache_table
Migrated:  0001_01_01_000001_create_cache_table
Migrating: 0001_01_01_000002_create_jobs_table
Migrated:  0001_01_01_000002_create_jobs_table
Migrating: 2024_01_01_000003_create_groups_table
Migrated:  2024_01_01_000003_create_groups_table
Migrating: 2024_01_01_000004_create_contacts_table
Migrated:  2024_01_01_000004_create_contacts_table
Migrating: 2024_01_01_000005_create_contact_group_table
Migrated:  2024_01_01_000005_create_contact_group_table
```

### 6. Compiler les assets

#### Pour le développement (avec hot reload)
```bash
npm run dev
```

#### Pour la production
```bash
npm run build
```

### 7. Lancer l'application

Dans un nouveau terminal :
```bash
php artisan serve
```

L'application sera accessible sur : **http://localhost:8000**

### 8. Créer votre premier compte

1. Accédez à `http://localhost:8000/register`
2. Remplissez le formulaire d'inscription
3. Vous serez automatiquement connecté et redirigé vers le tableau de bord

## Vérification de l'installation

### Vérifier les tables de la base de données

Dans phpMyAdmin, vérifiez que les tables suivantes ont été créées :
- `users`
- `contacts`
- `groups`
- `contact_group`
- `cache`
- `cache_locks`
- `jobs`
- `job_batches`
- `failed_jobs`
- `password_reset_tokens`
- `sessions`

### Tester les fonctionnalités

1. **Créer un groupe** : Accédez à "Groupes" > "+ Nouveau Groupe"
2. **Créer un contact** : Accédez à "Contacts" > "+ Nouveau Contact"
3. **Assigner un contact à un groupe** : Lors de la création/modification d'un contact
4. **Rechercher un contact** : Utilisez la barre de recherche sur la page des contacts

## Résolution des problèmes courants

### Erreur : "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Erreur de connexion à la base de données
- Vérifiez que MySQL est démarré dans XAMPP
- Vérifiez les informations de connexion dans `.env`
- Assurez-vous que la base de données `todo_contacts` existe

### Erreur : "Class not found"
```bash
composer dump-autoload
```

### Les styles ne s'affichent pas
```bash
npm run build
```

### Erreur de permissions (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

### Réinitialiser la base de données
```bash
php artisan migrate:fresh
```

⚠️ **Attention** : Cette commande supprime toutes les données !

## Commandes utiles

### Vider le cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Voir les routes disponibles
```bash
php artisan route:list
```

### Créer un utilisateur en console (optionnel)
```bash
php artisan tinker
```

Puis dans tinker :
```php
$user = new App\Models\User();
$user->name = "John Doe";
$user->email = "john@example.com";
$user->password = bcrypt("password123");
$user->save();
```

## Structure de la base de données

### Table `users`
- id
- name
- email
- password
- remember_token
- email_verified_at
- created_at
- updated_at

### Table `contacts`
- id
- user_id (FK → users.id)
- first_name
- last_name
- email
- phone
- company
- address
- notes
- created_at
- updated_at

### Table `groups`
- id
- user_id (FK → users.id)
- name
- description
- created_at
- updated_at

### Table `contact_group` (pivot)
- id
- contact_id (FK → contacts.id)
- group_id (FK → groups.id)
- created_at
- updated_at

## Prochaines étapes

Une fois l'installation terminée :

1. **Personnalisez l'application** selon vos besoins
2. **Ajoutez des seeders** pour des données de test
3. **Implémentez des tests** unitaires et fonctionnels
4. **Configurez un système de backup** pour la base de données
5. **Optimisez pour la production** si nécessaire

## Support

Pour toute question ou problème, consultez :
- La documentation Laravel : https://laravel.com/docs
- Le README.md du projet
- Les issues GitHub du projet
