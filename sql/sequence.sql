DROP SEQUENCE user_sequence;
DROP SEQUENCE owner_sequence;
DROP SEQUENCE rental_property_sequence;
DROP SEQUENCE lease_sequence;

CREATE SEQUENCE user_sequence START WITH 1
INCREMENT BY 1
minvalue 1
maxvalue 10000;

CREATE SEQUENCE owner_sequence START WITH 1
INCREMENT BY 1
minvalue 1
maxvalue 10000;

CREATE SEQUENCE rental_property_sequence START WITH 1
INCREMENT BY 1
minvalue 1
maxvalue 10000;

CREATE SEQUENCE lease_sequence START WITH 1
INCREMENT BY 1
minvalue 1
maxvalue 10000;
