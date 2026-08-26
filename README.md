# site-licence-pro-miaw-asrii — site de la Licence Pro MIAW / ASRII

Site web de la **Licence Professionnelle MIAW / ASRII** de l'IUT d'Évry (Université d'Évry Paris-Saclay) : vitrine de la formation (formations, campus, entreprises partenaires, alternance) et espace connecté pour les administrateurs, enseignants, étudiants et entreprises.

## Contexte

- **Quand** : mai – juin 2023 (premier commit le 11 mai 2023, dernier le 20 juin 2023).
- **Cadre** : projet de fin d'année de la **Licence Professionnelle MIAW / ASRII** (Métiers de l'Informatique : Applications Web / Administration et Sécurité des Réseaux et des Infrastructures Informatiques) à l'**IUT d'Évry**, réalisé pour le compte de la formation elle-même, à partir d'un cahier des charges fourni par l'équipe pédagogique (`public/supports_de_cours/Site_Web_LP-MIAW-ASR2I_Spécifications_fonctionnelle.pdf`).
- **Équipe** : 5 étudiants, dont Océane Glaneux (auteure principale du dépôt : ~55 % des commits). Travail en équipe sur GitLab (`asrii-site/lp-miaw-asrii`), branches par personne puis fusion dans `main`.
- **Objectif pédagogique** : concevoir de A à Z un site vitrine + espace membres multi-rôles en **PHP sans framework** (architecture MVC écrite à la main, routeur maison, mysqli), avec gestion des utilisateurs, des notes, des offres d'alternance, des supports de cours et des emplois du temps.
- **Depuis** : dépôt mirroré sur GitHub (`GLANEUX`) le 26 août 2026 puis réhabilité le même jour (voir « Statut ») pour qu'il tourne à nouveau, en une commande, avec les failles de sécurité d'origine corrigées.

## Statut

**Fonctionnel** — réhabilité le 2026-08-26.

Le projet ne démarrait plus (configuration et `.htaccess` non versionnés, aucun schéma SQL, chemin Windows en dur dans un `require`). Il tourne à nouveau en local et via Docker ; un parcours de 47 vérifications automatisées (pages publiques, inscription, connexion des 4 rôles, contrôle d'accès, uploads, injections SQL/XSS) passe sur la stack Docker sans aucun warning PHP.

Ce qui a été fait lors de la réhabilitation :

- Configuration : `conf.example.php` (local) et `conf.docker.php` (variables d'environnement), `.htaccess.example`, `router.php` pour le serveur PHP intégré.
- Base de données : schéma reconstitué depuis le code (`sql/01-schema.sql`, 10 tables avec clés étrangères) + jeu de démo (`sql/02-seed.sql`).
- Sécurité : toutes les requêtes contenant des entrées utilisateur passent par des **requêtes préparées** (`SqlModel::SqlRequest($sql, $params)`) ; échappement HTML systématique dans les vues via le helper `e()` ; uploads filtrés (liste blanche d'extensions, vérification MIME, nom aléatoire, 20 Mo max) et **exécution PHP désactivée dans `public/`** ; correction d'un bug qui laissait une entreprise non confirmée se connecter ; `session_regenerate_id` au login, cookies `HttpOnly`/`SameSite` ; erreurs loguées et jamais affichées.
- Compatibilité PHP 8 : sessions conditionnelles, tableaux initialisés, `?>` finaux retirés (ils cassaient les redirections de login).
- Front : logo cassé corrigé, une seule version de Bootstrap (5.3.3) chargée.

Fonctionnalités :

- Pages publiques : accueil, formations, entreprises, campus, alternances, RGPD.
- Inscription des entreprises (compte à confirmer par un administrateur), connexion par e-mail ou nom d'utilisateur.
- 4 rôles : `administrateur` (gestion des utilisateurs), `entreprise` (offres d'alternance, projets), `enseignant` (notes des étudiants, supports de cours, emplois du temps), `etudiant` (consultation).
- Upload de fichiers (supports de cours, emplois du temps).

## Stack

- **PHP >= 8.0** (testé avec 8.3), extension `mysqli` — aucune dépendance Composer.
- **MySQL / MariaDB** (MariaDB 11 en Docker).
- Architecture MVC maison : `index.php` (front-controller) → `routes.php` → `controller/*Controller.php` → `view/*.php`.
- Front : Bootstrap 5.3.3 et Font Awesome via CDN, CSS par page dans `public/css/`.

## Prérequis

- Docker >= 24 et Docker Compose v2 (voie recommandée), **ou**
- PHP >= 8.0 avec `mysqli` + un serveur MySQL/MariaDB (et Apache avec `mod_rewrite` si vous n'utilisez pas `php -S`).

## Lancement via Docker (recommandé)

```powershell
cd lp-miaw-asrii
Copy-Item .env.example .env      # adapter les mots de passe si besoin
docker compose up -d --build
```

Le site est disponible sur <http://localhost:8080>.

- Service `web` : `php:8.3-apache` + `mysqli` + `mod_rewrite`, port `8080` → `80`.
- Service `db` : `mariadb:11`, données dans le volume `db_data`. Les fichiers de `sql/` sont chargés **au premier démarrage uniquement**. Le port MySQL n'est pas publié (décommenter dans `docker-compose.yml` pour y accéder depuis l'hôte).
- Les fichiers uploadés sont persistés via des bind mounts sur `public/supports_de_cours` et `public/emplois_du_temps`.

Arrêt : `docker compose down` — ajouter `-v` pour supprimer la base et la recréer depuis `sql/` au prochain démarrage.

## Installation & lancement en local

1. Créer la base et charger le schéma (+ la démo si souhaité) :

   ```powershell
   mysql -u root -p -e "CREATE DATABASE asrii CHARACTER SET utf8mb4; CREATE USER 'asrii'@'localhost' IDENTIFIED BY 'changez-moi'; GRANT ALL ON asrii.* TO 'asrii'@'localhost';"
   Get-Content sql\01-schema.sql | mysql -u asrii -p asrii
   Get-Content sql\02-seed.sql   | mysql -u asrii -p asrii
   ```

2. Copier la configuration et renseigner les identifiants :

   ```powershell
   Copy-Item conf.example.php conf.php
   ```

   La constante `URL` est le préfixe de chemin : `''` si le site est servi à la racine, `'/lp-miaw-asrii'` s'il est dans un sous-dossier (XAMPP par exemple).

3. Lancer avec le serveur PHP intégré :

   ```powershell
   php -S localhost:8000 router.php
   ```

   puis ouvrir <http://localhost:8000>.

   Alternative Apache : copier `.htaccess.example` en `.htaccess` à la racine du projet et pointer un VirtualHost (ou un sous-dossier `htdocs`) sur ce répertoire, avec `AllowOverride All`.

## Comptes de démonstration

Créés par `sql/02-seed.sql`, mot de passe commun **`Demo1234!`** :

| Identifiant  | Rôle           |
|--------------|----------------|
| `admin`      | administrateur |
| `enseignant` | enseignant     |
| `etudiant`   | étudiant       |
| `entreprise` | entreprise (confirmée) |

À supprimer ou modifier avant toute mise en ligne réelle.

## Variables d'environnement

Utilisées par la stack Docker (`.env`, lu par `docker-compose.yml`, puis par `conf.docker.php`). Modèle : `.env.example`. Ne jamais commiter `.env` ni `conf.php`.

| Variable           | Rôle                                                        | Exemple        |
|--------------------|-------------------------------------------------------------|----------------|
| `DB_HOST`          | Hôte MySQL (nom du service compose)                         | `db`           |
| `DB_PORT`          | Port MySQL                                                  | `3306`         |
| `DB_NAME`          | Nom de la base                                              | `asrii`        |
| `DB_USER`          | Utilisateur applicatif                                      | `asrii`        |
| `DB_PASSWORD`      | Mot de passe de l'utilisateur applicatif                    | `change-me`    |
| `DB_ROOT_PASSWORD` | Mot de passe root MariaDB (conteneur `db` uniquement)       | `change-me`    |
| `APP_URL_PREFIX`   | Préfixe d'URL si servi dans un sous-dossier (vide à la racine) | *(vide)*    |

En local, les mêmes valeurs sont définies comme constantes dans `conf.php` (`URL`, `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`, `DB_PORT`).

## Structure du projet

```
lp-miaw-asrii/
├── index.php              # front-controller : routage, helper e(), chargement de conf
├── routes.php             # table URL → [Contrôleur, action]
├── router.php             # routeur pour `php -S`
├── conf.example.php       # modèle de configuration locale (→ conf.php, ignoré par Git)
├── conf.docker.php        # configuration via variables d'environnement (Docker)
├── .htaccess.example      # réécriture Apache (→ .htaccess)
├── controller/            # 15 contrôleurs (Home, Connexion, Inscription, Users, Notes,
│                          #   Alternances, Projets, Supports, EDT, RGPD…)
├── model/
│   ├── SqlModel.php       # connexion mysqli partagée, requêtes préparées, validation d'upload
│   └── ConnexionModel.php # classe User : recherche multi-tables, login
├── view/                  # 40 vues PHP, header.php / footer.php partagés
├── public/
│   ├── css/, img/, js/    # assets statiques
│   ├── supports_de_cours/ # uploads enseignants (gitignoré, .gitkeep)
│   └── emplois_du_temps/  # uploads enseignants (gitignoré, .gitkeep)
├── sql/
│   ├── 01-schema.sql      # 10 tables : adresses, administrateurs, enseignants, etudiants,
│   │                      #   entreprises, alternances, projets, notes, supports, emplois_du_temps
│   └── 02-seed.sql        # données de démo
├── Dockerfile             # php:8.3-apache, mysqli, rewrite, PHP désactivé dans public/
├── docker-compose.yml     # services web + db
└── .env.example
```

## Tests

Aucun test automatisé n'est versionné. La validation de la réhabilitation a été faite avec un script Playwright externe (47 vérifications) — voir `TODO.md` pour son intégration au dépôt.

Vérification syntaxique rapide :

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }
```
