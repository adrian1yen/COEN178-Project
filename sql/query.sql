SELECT  rental_id, owner_id, supervisor_id, street, cit, zipcode, rooms, rent, status, name
FROM (
	SELECT * FROM Rental_Property INNER JOIN Supervisor ON Rental_Property.supervisor_id = Supervisor.employee_id
	INNER JOIN Manager ON Manager.employee_id = Supervisor.manager_id
	INNER JOIN Employee ON Employee.employee_id = Manager.employee_id
);

SELECT Supervisor.employee_id, Employee.name, street, cit, zipcode
FROM Supervisor LEFT JOIN Rental_Property
ON  Supervisor.employee_id = Rental_Property.supervisor_id
LEFT JOIN Employee ON Supervisor.employee_id = Employee.employee_id;

SELECT Rental_Property.* FROM Rental_Property
WHERE Rental_Property.supervisor_id IN (
	SELECT Supervisor.employee_id FROM Supervisor INNER JOIN Manager
	ON Supervisor.manager_id = Manager.employee_id
	WHERE Manager.employee_id IN (
		SELECT manager_id FROM Branch WHERE
		branch_id = 'GreenField'
	)
) AND Rental_Property.owner_id = '1';

SELECT Rental_Property.* FROM Rental_Property
WHERE status = 'available'
AND cit = 'cit4'
AND rooms = 3
AND rent BETWEEN 100 AND 7000;

SELECT COUNT(*) FROM Rental_Property
WHERE status = 'available';

DELETE FROM Rental_Property
WHERE rental_id=3;

SELECT Supervisor.employee_id, Employee.name, street, cit, zipcode
FROM Supervisor LEFT JOIN Rental_Property
ON  Supervisor.employee_id = Rental_Property.supervisor_id
LEFT JOIN Employee ON Supervisor.employee_id = Employee.employee_id;


SELECT * FROM Lease WHERE renter_name='renter1';

SELECT renter_name FROM Lease GROUP BY renter_name
HAVING COUNT(*) > 1;

SELECT AVG(rent), cit FROM Rental_Property GROUP BY cit;

SELECT renter_name, street, cit, zipcode FROM Lease INNER JOIN Rental_Property ON Lease.rental_id = Rental_Property.rental_id
-- SELECT renter_name FROM Lease INNER JOIN Rental_Property ON Lease.rental_id = Rental_Property.rental_id
WHERE (end_date - SYSDATE) < 60;
