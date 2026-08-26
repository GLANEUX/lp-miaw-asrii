-- Schéma de la base de données du site LP MIAW ASRII.
-- Reconstitué à partir des requêtes de l'application (aucun dump n'était versionné).
-- Chargé automatiquement au premier démarrage du conteneur MariaDB (docker-compose).

CREATE TABLE IF NOT EXISTS adresses (
    id          INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    adresse     VARCHAR(255) NOT NULL,
    complement  VARCHAR(255) NULL,
    code_postal VARCHAR(10)  NOT NULL,
    ville       VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS administrateurs (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom           VARCHAR(100) NOT NULL,
    prenom        VARCHAR(100) NOT NULL,
    email         VARCHAR(255) NOT NULL UNIQUE,
    username      VARCHAR(100) NOT NULL UNIQUE,
    password      VARCHAR(255) NOT NULL,
    last_login    DATETIME NULL,
    last_login_ip VARCHAR(45) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS enseignants (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom           VARCHAR(100) NOT NULL,
    prenom        VARCHAR(100) NOT NULL,
    adresse_id    INT UNSIGNED NULL,
    email         VARCHAR(255) NOT NULL UNIQUE,
    username      VARCHAR(100) NOT NULL UNIQUE,
    password      VARCHAR(255) NOT NULL,
    last_login    DATETIME NULL,
    last_login_ip VARCHAR(45) NULL,
    CONSTRAINT fk_enseignants_adresse FOREIGN KEY (adresse_id) REFERENCES adresses (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS etudiants (
    id                INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom               VARCHAR(100) NOT NULL,
    prenom            VARCHAR(100) NOT NULL,
    date_de_naissance DATE NULL,
    adresse_id        INT UNSIGNED NULL,
    email             VARCHAR(255) NOT NULL UNIQUE,
    username          VARCHAR(100) NOT NULL UNIQUE,
    password          VARCHAR(255) NOT NULL,
    last_login        DATETIME NULL,
    last_login_ip     VARCHAR(45) NULL,
    CONSTRAINT fk_etudiants_adresse FOREIGN KEY (adresse_id) REFERENCES adresses (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS entreprises (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    societe       VARCHAR(150) NOT NULL,
    siret         VARCHAR(14)  NOT NULL,
    adresse_id    INT UNSIGNED NULL,
    numero        VARCHAR(20)  NULL,
    email         VARCHAR(255) NOT NULL UNIQUE,
    username      VARCHAR(100) NOT NULL UNIQUE,
    password      VARCHAR(255) NOT NULL,
    confirme      TINYINT(1)   NOT NULL DEFAULT 0,
    last_login    DATETIME NULL,
    last_login_ip VARCHAR(45) NULL,
    CONSTRAINT fk_entreprises_adresse FOREIGN KEY (adresse_id) REFERENCES adresses (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS alternances (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    entreprise_id INT UNSIGNED NOT NULL,
    poste         VARCHAR(150) NOT NULL,
    description   TEXT NOT NULL,
    CONSTRAINT fk_alternances_entreprise FOREIGN KEY (entreprise_id) REFERENCES entreprises (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS projets (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    entreprise_id INT UNSIGNED NOT NULL,
    titre         VARCHAR(150) NOT NULL,
    description   TEXT NOT NULL,
    CONSTRAINT fk_projets_entreprise FOREIGN KEY (entreprise_id) REFERENCES entreprises (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS notes (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    etudiant_id   INT UNSIGNED NOT NULL,
    enseignant_id INT UNSIGNED NULL,
    matiere       VARCHAR(100) NOT NULL,
    libelle       VARCHAR(150) NOT NULL,
    commentaire   TEXT NULL,
    note          DECIMAL(5,2) NOT NULL,
    CONSTRAINT fk_notes_etudiant   FOREIGN KEY (etudiant_id)   REFERENCES etudiants (id)   ON DELETE CASCADE,
    CONSTRAINT fk_notes_enseignant FOREIGN KEY (enseignant_id) REFERENCES enseignants (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS supports (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titre         VARCHAR(150) NOT NULL,
    matiere       VARCHAR(100) NOT NULL,
    url           VARCHAR(255) NOT NULL,
    enseignant_id INT UNSIGNED NULL,
    CONSTRAINT fk_supports_enseignant FOREIGN KEY (enseignant_id) REFERENCES enseignants (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS emplois_du_temps (
    id   INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    url  VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
