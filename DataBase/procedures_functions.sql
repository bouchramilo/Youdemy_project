
-- pour afficher les tabels
CALL afficherTables();

-- pour supprimer les tabels
CALL supprimerTables();


-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- Les procedures et les fonctions : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    SELECT * FROM utilisateurs;
    SELECT * FROM enseignants;
    SELECT * FROM categorie;
    SELECT * FROM cours;
    SELECT * FROM inscription_cours;
    SELECT * FROM tags;
    SELECT * FROM cours_tags;
-- Procedures : ==============================================================================================================================================
-- procedure pour afficher toutes les tables : 

DELIMITER $$ 
CREATE PROCEDURE afficherTables()
BEGIN
    SELECT * FROM utilisateurs;
    SELECT * FROM enseignants;
    SELECT * FROM categorie;
    SELECT * FROM cours;
    SELECT * FROM inscription_cours;
    SELECT * FROM tags;
    SELECT * FROM cours_tags;
END$$
DELIMITER ;



-- procedure pour supprimer toute les tables :

DELIMITER $$ 
CREATE PROCEDURE supprimerTables()
BEGIN

    DROP TABLE IF EXISTS cours_tags;
    DROP TABLE IF EXISTS tags;
    DROP TABLE IF EXISTS inscription_cours;
    DROP TABLE IF EXISTS cours;
    DROP TABLE IF EXISTS categorie;
    DROP TABLE IF EXISTS enseignants;
    DROP TABLE IF EXISTS utilisateurs;

END$$
DELIMITER ;













SELECT 
    ic.id_user,
    CONCAT(u.prenom, ' ', u.nom) AS nom_etudiant,
    u.email,
    c.id_cours,
    c.titre,
    c.description,
    c.type_contenu,
    c.photo,
    DATE_FORMAT(ic.date_inscription, '%d-%m-%Y') AS date_inscription,
    cat.titre_categorie
FROM 
    inscription_cours ic
INNER JOIN 
    cours c ON ic.id_cours = c.id_cours
LEFT JOIN 
    categorie cat ON c.id_categorie = cat.id_categorie
INNER JOIN 
    utilisateurs u ON ic.id_user = u.id_user
WHERE 
    c.id_enseignant = 2 AND c.id_cours = 5
ORDER BY date_inscription;
