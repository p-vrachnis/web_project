drop database if exists web_project;
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

CREATE TABLE user_data(
	username VARCHAR(25) NOT NULL,
	timestampMs VARCHAR(13) NOT NULL,
	latitudeE7 INT(10) NOT NULL,
	longitudeE7 INT(10) NOT NULL,
	activity VARCHAR(10),
    PRIMARY KEY(timestampMs),
	FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB CHARACTER SET greek COLLATE greek_general_ci;



CREATE TABLE user_score(
	username VARCHAR(25) NOT NULL,
	score FLOAT(5) NOT NULL,
	month INT(2) NOT NULL,
	FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB CHARACTER SET greek COLLATE greek_general_ci;
