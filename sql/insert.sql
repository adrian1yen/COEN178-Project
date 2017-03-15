INSERT INTO Employee VALUES('e1', 'bob', '111111', TO_DATE('01/01/2000', 'MM/DD/YYYY'));
INSERT INTO Employee VALUES('e2', 'joe', '22222', TO_DATE('01/01/2000', 'MM/DD/YYYY'));
INSERT INTO Employee VALUES('e3', 'billy', '33333', TO_DATE('01/01/2000', 'MM/DD/YYYY'));
INSERT INTO Employee VALUES('e4', 'carl', '44444', TO_DATE('01/01/2000', 'MM/DD/YYYY'));
INSERT INTO Employee VALUES('e5', 'john', '55555', TO_DATE('01/01/2000', 'MM/DD/YYYY'));
INSERT INTO Employee VALUES('e6', 'green', '55555', TO_DATE('01/01/2000', 'MM/DD/YYYY'));

INSERT INTO Manager VALUES('e1');
INSERT INTO Manager VALUES('e6');

INSERT INTO Supervisor VALUES('e2', 'e1');
INSERT INTO Supervisor VALUES('e3', 'e1');
INSERT INTO Supervisor VALUES('e4', 'e1');
INSERT INTO Supervisor VALUES('e5', 'e6');

INSERT INTO Branch VALUES('b1', '11111', 'street1', 'city1', 'zip1', 'e1');
INSERT INTO Branch VALUES('GreenField', '11111', 'street1', 'city1', 'zip1', 'e6');

-- INSERT INTO Property_Owner VALUES('o1', 'owner1', 'street2', 'city2', 'zip2', '66666', 0);
-- INSERT INTO Property_Owner VALUES('o2', 'owner1', 'street2', 'city2', 'zip2', '66666', 0);
EXECUTE addPropertyOwner('owner1', 'street2', 'city2', 'zip2', '66666', 'adrian', 'password');
EXECUTE addPropertyOwner('owner2', 'street3', 'city3', 'zip3', '77777', 'ayen', 'password');

INSERT INTO Rental_Property VALUES(rental_property_sequence.nextval, '1', 'e2', 'street3', 'cit3', 'zip3', 5, 4000, 'available');
INSERT INTO Rental_Property VALUES(rental_property_sequence.nextval, '2', 'e3', 'street4', 'cit4', 'zip4', 3, 3000, 'available');
INSERT INTO Rental_Property VALUES(rental_property_sequence.nextval, '2', 'e3', 'street4', 'cit4', 'zip4', 3, 8000, 'available');
INSERT INTO Rental_Property VALUES(rental_property_sequence.nextval, '1', 'e5', 'street4', 'cit4', 'zip4', 3, 2000, 'available');
INSERT INTO Rental_Property VALUES(rental_property_sequence.nextval, '1', 'e5', 'street4', 'cit4', 'zip4', 3, 4000, 'available');

EXECUTE addLease(lease_sequence.nextval, '1', 'renter1', '3232', '2323', '4343', 'emergency1', TO_DATE('01/01/2017', 'MM/DD/YYYY'), TO_DATE('01/01/2018', 'MM/DD/YYYY')); 
EXECUTE addLease(lease_sequence.nextval, '2', 'renter2', '3232', '2323', '4343', 'emergency1', TO_DATE('01/01/2017', 'MM/DD/YYYY'), TO_DATE('07/20/2017', 'MM/DD/YYYY')); 
EXECUTE addLease(lease_sequence.nextval, '3', 'renter2', '3232', '2323', '4343', 'emergency1', TO_DATE('01/01/2017', 'MM/DD/YYYY'), TO_DATE('08/01/2017', 'MM/DD/YYYY')); 
EXECUTE addLease(lease_sequence.nextval, '4', 'renter2', '3232', '2323', '4343', 'emergency1', TO_DATE('09/11/2016', 'MM/DD/YYYY'), TO_DATE('04/01/2017', 'MM/DD/YYYY')); 

EXECUTE deleteLease(3);
