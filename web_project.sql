drop database web_project;
create database web_project;
use web_project;


CREATE TABLE users(
  userID CHAR(32) NOT NULL,
  username VARCHAR(25) NOT NULL,
  password CHAR(32) NOT NULL,
  email VARCHAR(50) NOT NULL,
  PRIMARY KEY(username)
)ENGINE = InnoDB CHARACTER SET greek COLLATE greek_general_ci;

INSERT INTO users VALUES
('1','admin','81dc9bdb52d04dc20036dbd8313ed055','admin@hotmail.com'),
('2','user','81dc9bdb52d04dc20036dbd8313ed055','user@hotmail.com');
