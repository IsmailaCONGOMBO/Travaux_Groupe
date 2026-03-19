# 📇 Application de Gestion de Contacts

Application web de gestion de contacts développée avec Laravel 12 et MySQL, utilisant une architecture n-tier avec les principes SOLID.

## 🎯 Fonctionnalités

- **Authentification sécurisée** : Inscription et connexion des utilisateurs
- **Gestion des contacts** : Créer, lire, mettre à jour et supprimer des contacts
- **Organisation par groupes** : Regrouper les contacts dans des catégories personnalisées
- **Recherche avancée** : Rechercher des contacts par nom, email ou entreprise
- **Interface moderne** : UI responsive avec TailwindCSS

## 🏗️ Architecture

L'application suit une architecture n-tier pour une meilleure séparation des responsabilités :

### Couche de Présentation
- **Controllers** : Gèrent les requêtes HTTP et les réponses
- **Views** : Templates Blade pour l'interface utilisateur
- **Requests** : Validation des données entrantes

### Couche Logique Métier
- **Services** : Contiennent la logique métier de l'application
- **ContactService** : Gestion des opérations sur les contacts
- **GroupService** : Gestion des opérations sur les groupes

### Couche d'Accès aux Données
- **Repositories** : Abstraction de l'accès aux données
- **Models** : Modèles Eloquent avec relations
- **Migrations** : Schéma de base de données

## 🛠️ Technologies Utilisées

- **Backend** : Laravel 12 (PHP 8.2+)
- **Base de données** : MySQL via XAMPP
- **Frontend** : Blade Templates, TailwindCSS, Alpine.js
- **Architecture** : N-tier, Repository Pattern, Service Layer
- **Principes** : SOLID, DRY, Dependency Injection

## 📋 Prérequis

- PHP 8.2 ou supérieur
- Composer
- XAMPP (MySQL + Apache)
- Node.js et NPM

## 🚀 Installation

### 1. Cloner le projet
```bash
git clone <votre-repo>
cd todo-contacts
```

### 2. Installer les dépendances PHP
```bash
composer install
```

### 3. Installer les dépendances JavaScript
```bash
npm install
```

### 4. Configurer l'environnement
Copiez le fichier `.env.example` vers `.env` et configurez votre base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_contacts
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Générer la clé d'application
```bash
php artisan key:generate
```

### 6. Créer la base de données
Créez une base de données MySQL nommée `todo_contacts` dans phpMyAdmin (XAMPP).

### 7. Exécuter les migrations
```bash
php artisan migrate
```

### 8. Compiler les assets
```bash
npm run build
```

Pour le développement :
```bash
npm run dev
```

### 9. Lancer le serveur
```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

## 📁 Structure du Projet

```
app/
├── Http/
│   ├── Controllers/        # Contrôleurs (Couche Présentation)
│   ├── Middleware/         # Middlewares de sécurité
│   └── Requests/           # Validation des requêtes
├── Models/                 # Modèles Eloquent
├── Repositories/           # Couche d'accès aux données
│   ├── Contracts/          # Interfaces des repositories
│   ├── ContactRepository.php
│   └── GroupRepository.php
├── Services/               # Couche logique métier
│   ├── ContactService.php
│   └── GroupService.php
└── Providers/              # Service Providers

database/
└── migrations/             # Migrations de base de données

resources/
├── views/                  # Templates Blade
│   ├── auth/              # Pages d'authentification
│   ├── contacts/          # Vues des contacts
│   ├── groups/            # Vues des groupes
│   └── layouts/           # Layout principal
└── css/                   # Styles CSS

routes/
├── web.php                # Routes web
└── auth.php               # Routes d'authentification
```

## 🔒 Sécurité

- **Protection CSRF** : Tous les formulaires sont protégés par token CSRF
- **Validation des données** : Validation stricte via Form Requests
- **Authentification** : Middleware auth sur toutes les routes protégées
- **Autorisation** : Vérification de propriété des ressources
- **Hash des mots de passe** : Bcrypt pour le stockage sécurisé
- **Protection XSS** : Échappement automatique avec Blade

## ⚡ Optimisations

- **Index de base de données** : Sur les colonnes fréquemment recherchées
- **Eager Loading** : Chargement anticipé des relations pour éviter N+1
- **Pagination** : Limitation des résultats pour de meilleures performances
- **Cache** : Configuration pour mise en cache future
- **Transactions** : Utilisation de transactions pour l'intégrité des données

## 📝 Utilisation

### Créer un compte
1. Accédez à `/register`
2. Remplissez le formulaire d'inscription
3. Connectez-vous avec vos identifiants

### Gérer les contacts
1. Cliquez sur "Contacts" dans le menu
2. Utilisez le bouton "+ Nouveau Contact" pour ajouter un contact
3. Remplissez les informations (nom, prénom, email, téléphone, etc.)
4. Assignez le contact à un ou plusieurs groupes

### Organiser par groupes
1. Cliquez sur "Groupes" dans le menu
2. Créez des groupes (Famille, Travail, Amis, etc.)
3. Assignez vos contacts aux groupes appropriés

## 🧪 Tests

Pour exécuter les tests (à implémenter) :
```bash
php artisan test
```

## 📚 Principes de Conception Appliqués

### SOLID
- **S**ingle Responsibility : Chaque classe a une responsabilité unique
- **O**pen/Closed : Ouvert à l'extension, fermé à la modification
- **L**iskov Substitution : Les interfaces peuvent être substituées
- **I**nterface Segregation : Interfaces spécifiques et ciblées
- **D**ependency Inversion : Dépendance sur les abstractions

### Autres Patterns
- **Repository Pattern** : Abstraction de la couche de données
- **Service Layer** : Logique métier centralisée
- **Dependency Injection** : Injection de dépendances via constructeur
- **MVC** : Séparation Modèle-Vue-Contrôleur

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou un pull request.

## 📄 Licence

Ce projet est sous licence MIT.
