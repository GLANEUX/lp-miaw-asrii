-- Données de démonstration (chargées après le schéma au premier démarrage).
-- Tous les comptes ci-dessous ont le mot de passe :  Demo1234!
-- À SUPPRIMER / MODIFIER avant toute mise en production.

INSERT INTO adresses (id, adresse, complement, code_postal, ville) VALUES
    (1, '1 rue du Père Jarlan', NULL, '91000', 'Évry-Courcouronnes'),
    (2, '10 avenue de la République', 'Bâtiment B', '91300', 'Massy');

INSERT INTO administrateurs (nom, prenom, email, username, password) VALUES
    ('Admin', 'Site', 'admin@example.com', 'admin', '$2y$10$jemak/fcMJ.d255vSg5Ox.g2NzPkXGc2brd0nu/g4xIGEFkNTfmfu');

INSERT INTO enseignants (nom, prenom, adresse_id, email, username, password) VALUES
    ('Dupont', 'Marie', 1, 'enseignant@example.com', 'enseignant', '$2y$10$jemak/fcMJ.d255vSg5Ox.g2NzPkXGc2brd0nu/g4xIGEFkNTfmfu');

INSERT INTO etudiants (nom, prenom, date_de_naissance, adresse_id, email, username, password) VALUES
    ('Martin', 'Lucas', '2002-05-14', 1, 'etudiant@example.com', 'etudiant', '$2y$10$jemak/fcMJ.d255vSg5Ox.g2NzPkXGc2brd0nu/g4xIGEFkNTfmfu');

INSERT INTO entreprises (societe, siret, adresse_id, numero, email, username, password, confirme) VALUES
    ('TechCorp', '12345678900012', 2, '0160000000', 'entreprise@example.com', 'entreprise', '$2y$10$jemak/fcMJ.d255vSg5Ox.g2NzPkXGc2brd0nu/g4xIGEFkNTfmfu', 1);

INSERT INTO alternances (entreprise_id, poste, description) VALUES
    (1, 'Développeur web full-stack (alternance)', 'Participation au développement d\'applications web PHP/JS au sein de l\'équipe produit.');

INSERT INTO projets (entreprise_id, titre, description) VALUES
    (1, 'Refonte du site vitrine', 'Projet tutoré : refonte responsive du site vitrine avec un CMS headless.');

INSERT INTO notes (etudiant_id, enseignant_id, matiere, libelle, commentaire, note) VALUES
    (1, 1, 'Développement web', 'TP1 - PHP MVC', 'Bon travail, code bien structuré.', 16.50);
