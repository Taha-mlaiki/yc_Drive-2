DROP DATABASE IF EXISTS driveloc;
CREATE DATABASE driveloc;

USE driveloc;

CREATE TABLE role (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255)
);

INSERT INTO role (name) VALUES
 ("user"),
 ("admin");

CREATE TABLE users (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	username VARCHAR(255),
    email VARCHAR(255),
    password TEXT,
	role_id INT DEFAULT 1 ,
    FOREIGN KEY (role_id) REFERENCES role(id)
);

CREATE TABLE category (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(255)
);

CREATE TABLE vehicle (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
    description TEXT ,
    modal INT,
    price INT,
    available BOOLEAN ,
    category_id INT ,
    FOREIGN KEY (category_id) REFERENCES category(id)
);

CREATE TABLE review (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	star INT,
    user_id INT ,
	vehicle_id INT ,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicle(id)
);

CREATE TABLE reservation (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	date DATE,
    place VARCHAR(255),
    user_id INT ,
	vehicle_id INT ,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicle(id)
)

ALTER TABLE vehicle 
ADD COLUMN imgUrl TEXT 