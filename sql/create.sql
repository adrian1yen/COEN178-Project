DROP TABLE Lease;
DROP TABLE Rental_Property;
DROP TABLE Property_Owner;
DROP TABLE Branch;
DROP TABLE Supervisor;
DROP TABLE Manager;
DROP TABLE Employee;
DROP TABLE User_Profile;

CREATE TABLE User_Profile(
	user_id CHAR(10) PRIMARY KEY,
	username CHAR(50) NOT NULL UNIQUE,
	password CHAR(50) NOT NULL
);

CREATE TABLE Employee(
	employee_id CHAR(10) PRIMARY KEY,
	name CHAR(50),
	phone_number CHAR(10),
	start_date DATE
);

CREATE TABLE Manager(
	employee_id CHAR(10) PRIMARY KEY,
	FOREIGN KEY (employee_id) REFERENCES Employee(employee_id) ON DELETE CASCADE
);

CREATE TABLE Supervisor(
	employee_id CHAR(10) PRIMARY KEY,
	manager_id CHAR(10),
	FOREIGN KEY (employee_id) REFERENCES Employee(employee_id) ON DELETE CASCADE,
	FOREIGN KEY (manager_id) REFERENCES Manager(employee_id) ON DELETE CASCADE
);

CREATE TABLE Branch(
	branch_id CHAR(10) PRIMARY KEY,
	phone_number CHAR(10),
	street CHAR(50),
	city CHAR(50),
	zipcode CHAR(50),
	manager_id CHAR(10),
	FOREIGN KEY (manager_id) REFERENCES Manager(employee_id) ON DELETE CASCADE
);

CREATE TABLE Property_Owner(
	owner_id CHAR(10) PRIMARY KEY,
	user_id CHAR(10) NOT NULL UNIQUE,
	name CHAR(50),
	street CHAR(50),
	cit CHAR(50),
	zipcode CHAR(50),
	phone_number CHAR(10),
	fee NUMBER (7,2) DEFAULT 0,
	FOREIGN KEY (user_id) REFERENCES User_Profile(user_id) ON DELETE CASCADE
);

CREATE TABLE Rental_Property(
	rental_id CHAR(10) PRIMARY KEY,
	owner_id CHAR(10),
	supervisor_id CHAR(10),
	street CHAR(50),
	cit CHAR(50),
	zipcode CHAR(50),
	rooms NUMBER(3,0),
	rent NUMBER(7,2),
	status CHAR(20) DEFAULT 'available' CHECK (status in ('available', 'leased')),
	FOREIGN KEY (owner_id) REFERENCES Property_Owner(owner_id) ON DELETE CASCADE,
	FOREIGN KEY (supervisor_id) REFERENCES Supervisor(employee_id)
);

CREATE TABLE Lease(
	lease_id CHAR(10) PRIMARY KEY,
	rental_id CHAR(10),
	renter_name CHAR(50),
	home_phone_number CHAR(10),
	work_phone_number CHAR(10),
	emergency_contact_number CHAR(10),
	emergency_contact_name CHAR(50),
	start_date DATE,
	end_date DATE,
	deposit NUMBER(7,2),
	rent NUMBER(7,2),
	supervisors_name CHAR(50),
	CONSTRAINT lease_length CHECK (end_date - start_date <= 366 AND end_date - start_date >= 182),
	FOREIGN KEY (rental_id) REFERENCES Rental_Property(rental_id) ON DELETE CASCADE
);
