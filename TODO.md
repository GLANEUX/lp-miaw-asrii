# TODO — lp-miaw-asrii

État au 2026-08-26 : le site tourne en local et via Docker, les failles bloquantes (injection SQL, XSS, upload de scripts, connexion d'entreprises non confirmées) sont corrigées. Ce qui suit est ce qui reste.

## Bugs connus

- `view/emploiDuTemps.php` et `view/supportsDeCours.php` : la même `$data['url']` est répétée pour chaque ligne du tableau (tous les liens pointent vers le même fichier).
- Page de connexion : les messages d'erreur ne s'affichent pas (`$error` n'est jamais transmis à la vue).
- Aucun `ORDER BY` dans les requêtes de listes : l'ordre d'affichage dépend du moteur SQL.
- Après un `INSERT` dans `adresses`, l'id est retrouvé par un `SELECT id FROM adresses WHERE …` sur les champs saisis (ambigu si deux adresses identiques) → utiliser `mysqli->insert_id`.
- `public/js/script.js` est vide mais chargé sur toutes les pages.

## Réhab restante

- Rien ne bloque le démarrage. Points de finition :
  - Versionner le script de vérification Playwright (47 cas) dans un dossier `tests/` et documenter son lancement.
  - Ajouter une CI minimale (`php -l` sur tous les fichiers, build de l'image Docker).
  - Compresser les bannières JPG de `public/img/` (1,4 à 4,4 Mo chacune).

## Améliorations possibles

- **Dette technique** : ~3 600 lignes de contrôleurs avec, dans chaque action, 4 blocs quasi identiques (un par rôle). Factoriser : middleware d'authentification / autorisation, une requête par action, une classe par fichier avec autoload (PSR-4).
- Validation côté serveur des formulaires : format SIRET (14 chiffres), e-mail, note comprise entre 0 et 20, champs obligatoires.
- Mot de passe oublié / réinitialisation.
- Pagination des listes (utilisateurs, offres, projets, notes).
- Page 404 stylée (actuellement `Page not found` en texte brut).
- Contenu : les adresses e-mail d'enseignants présentes dans `view/formations.php` et `view/rgpd.php` doivent être validées par les personnes concernées ; le PDF de spécifications commité dans `public/supports_de_cours/` doit avoir un droit de diffusion confirmé.
- Décider de la visibilité du dépôt (actuellement public ; ne contient que des données de démo).

## Sécurité

Findings restants, non corrigés lors de la réhabilitation :

- **CSRF** : les suppressions et confirmations se font en **GET sans jeton** : `/users/list/*?id=`, `/users/list/entreprise/confirme`, `/notes/delete`, `/offres/delete`, `/projets/delete`, `/supports/delete`, `/emplois-du-temps/delete`. Passer en POST avec un token de session.
- Pas de limitation de tentatives (rate-limiting) sur `/connexion`.
- Contrôle d'accès horizontal partiel : la lecture des supports et emplois du temps par `id` ne vérifie pas le propriétaire (faible impact, ressources destinées à être partagées entre rôles).
- Comptes de démo (`Demo1234!`) dans `sql/02-seed.sql` : à retirer avant tout déploiement réel.
- Pas d'en-têtes de sécurité HTTP (CSP, `X-Frame-Options`, `X-Content-Type-Options`) dans la configuration Apache.
