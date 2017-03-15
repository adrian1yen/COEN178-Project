CREATE OR REPLACE PROCEDURE addLease
(lease_id IN Lease.lease_id%type, input_rental_id IN Lease.rental_id%type, renter_name IN Lease.renter_name%type, home_phone_number IN Lease.home_phone_number%type,
work_phone_number IN Lease.work_phone_number%type, emergency_contact_number IN Lease.emergency_contact_number%type,
emergency_contact_name IN Lease.emergency_contact_name%type,
start_date IN Lease.start_date%type, end_date IN Lease.end_date%type)
AS

lease_rent Lease.rent%type;
rental_status Rental_Property.status%type;
supervisor_name Employee.name%type;

BEGIN
	SELECT status INTO rental_status FROM Rental_Property WHERE rental_id = input_rental_id;
	IF rental_status = 'available' THEN
		SELECT rent INTO lease_rent FROM Rental_Property WHERE Rental_Property.rental_id = input_rental_id;
		IF end_date - start_date < 250 THEN
			lease_rent := lease_rent * 1.1;
		END IF;

		SELECT name INTO supervisor_name FROM Employee INNER JOIN Rental_Property
		ON Employee.employee_id = Rental_Property.supervisor_id
		WHERE Rental_Property.rental_id = input_rental_id;

		INSERT INTO Lease VALUES(lease_id, input_rental_id, renter_name, home_phone_number, work_phone_number, emergency_contact_number,
		emergency_contact_name, start_date, end_date, lease_rent, lease_rent, supervisor_name);

		UPDATE Rental_Property
		SET rent = rent * 1.1
		WHERE Rental_Property.rental_id = input_rental_id;
	END IF;
END; 
/ 
show errors;

CREATE OR REPLACE PROCEDURE deleteLease
(input_lease_id IN Lease.lease_id%type)
AS

lease_rental_id Rental_Property.rental_id%type;

BEGIN
	SELECT rental_id INTO lease_rental_id FROM Lease WHERE lease_id = input_lease_id;
	DELETE FROM LEASE Where lease_id = input_lease_id;
	UPDATE Rental_Property
	SET status = 'available'
	WHERE rental_id = lease_rental_id;
END;
/
show errors;

CREATE OR REPLACE PROCEDURE addPropertyOwner
(name IN Property_Owner.name%type, street IN Property_Owner.street%type, 
cit IN Property_Owner.cit%type, zipcode IN Property_Owner.zipcode%type, phone_number IN Property_Owner.phone_number%type, 
username IN User_Profile.username%type, password IN User_Profile.password%type)
AS

user_id User_Profile.user_id%type;

BEGIN
	user_id := user_sequence.nextval;
	INSERT INTO User_Profile VALUES(user_id,username,password);
	INSERT INTO Property_Owner VALUES(owner_sequence.nextval,user_id,name,street,cit,zipcode,phone_number,0);
END;
/
show errors;

