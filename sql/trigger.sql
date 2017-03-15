CREATE OR REPLACE Trigger Create_Lease
AFTER INSERT ON Lease
FOR EACH ROW
	BEGIN 
		UPDATE Rental_Property
		SET status = 'leased'
		WHERE rental_id = :NEW.rental_id;
	END;
/
Show Errors;

CREATE OR REPLACE Trigger Add_Owner_Fee
AFTER INSERT ON Rental_Property
FOR EACH ROW
	BEGIN 
		UPDATE Property_Owner
		SET Fee = Fee + 400
		WHERE owner_id = :NEW.owner_id;
	END;
/
Show Errors;

CREATE OR REPLACE Trigger Remove_Owner_Fee
AFTER DELETE ON Rental_Property
FOR EACH ROW
	BEGIN 
		UPDATE Property_Owner
		SET Fee = Fee - 400
		WHERE owner_id = :NEW.owner_id;
	END;
/
Show Errors;
