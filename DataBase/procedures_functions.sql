
-- pour afficher les tabels
CALL afficherTables();

-- pour supprimer les tabels
-- CALL supprimerTables();


-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- Les procedures et les fonctions : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

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

