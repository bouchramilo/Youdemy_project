

-- Les triggers : 

-- trigger pour mettre le premier utilisateurs enregistrer comme un "Admin" : 

DELIMITER $$

CREATE TRIGGER before_insert_user
BEFORE INSERT ON utilisateurs
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM utilisateurs) = 0 THEN
        SET NEW.role = 'Admin';
    END IF;
END$$

DELIMITER ;




-- test 



select concat(u.nom , ' ' , u.prenom) as full_name_teatcher , count(ic.id_cours) as nombre_inscription
from utilisateurs u 
left join cours c on u.id_user = c.id_enseignant
left join inscription_cours ic on c.id_cours = ic.id_cours
where u.role = 'Enseignant'
group BY u.id_user ;




