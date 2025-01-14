

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