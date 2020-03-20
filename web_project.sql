drop database if exists web_project;
create database web_project;
use web_project;


CREATE TABLE users(
	userID CHAR(32) NOT NULL,
	username VARCHAR(25) NOT NULL,
	password CHAR(32) NOT NULL,
	email VARCHAR(50) NOT NULL,
	last_upload datetime,
	PRIMARY KEY(username)
)ENGINE = InnoDB CHARACTER SET greek COLLATE greek_general_ci;

INSERT INTO users (userID,username,password,email) VALUES
('0','admin','81dc9bdb52d04dc20036dbd8313ed055','admin@hotmail.com'),
('1','user1','81dc9bdb52d04dc20036dbd8313ed055','user1@hotmail.com'),
('2','user2','81dc9bdb52d04dc20036dbd8313ed055','user2@hotmail.com'),
('3','user3','81dc9bdb52d04dc20036dbd8313ed055','user3@hotmail.com'),
('4','user4','81dc9bdb52d04dc20036dbd8313ed055','user4@hotmail.com'),
('5','user5','81dc9bdb52d04dc20036dbd8313ed055','user5@hotmail.com');

CREATE TABLE user_data(
	username VARCHAR(25) NOT NULL,
	timestampMs VARCHAR(13) NOT NULL,
	latitudeE7 INT NOT NULL,
	longitudeE7 INT NOT NULL,
	activity VARCHAR(10),
    PRIMARY KEY(username,timestampMs),
	FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB CHARACTER SET greek COLLATE greek_general_ci;


CREATE TABLE user_score(
	username VARCHAR(25) NOT NULL,
	score FLOAT(5) NOT NULL,
	score_date DATE NOT NULL,
	PRIMARY KEY(username,score_date),
	FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB CHARACTER SET greek COLLATE greek_general_ci;

CREATE TABLE upload(
	username VARCHAR(25) NOT NULL,
    upload_date DATE NOT NULL,
	PRIMARY KEY(username),
	FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB CHARACTER SET greek COLLATE greek_general_ci;
