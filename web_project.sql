drop database web_project;
create database web_project;
use web_project;


CREATE TABLE users(
  userID CHAR(128) NOT NULL,
  username VARCHAR(25) NOT NULL,
  password VARCHAR (50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  PRIMARY KEY(username)
)ENGINE = InnoDB CHARACTER SET greek COLLATE greek_general_ci;

INSERT INTO users VALUES 
('1','admin','1234','admin@hotmail.com');