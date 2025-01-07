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

ALTER TABLE review 
MODIFY COLUMN star FLOAT

ALTER TABLE reservation 
ADD COLUMN status ENUM("Pending","Accepted","Canceled") DEFAULT "Pending" 

ALTER TABLE review
ADD COLUMN isArchived BOOLEAN DEFAULT false



-- Vue SQL pour la liste des véhicules 

SELECT v.id AS vehicle_id, 
            v.name AS vehicle_name, 
            v.description AS vehicle_description, 
            v.price AS vehicle_price, 
            v.modal AS vehicle_modal, 
            v.available AS vehicle_available, 
            v.imgUrl AS vehicle_image, 
            c.name AS category, 
            r.id AS review_id,
            r.star AS review_star, 
            u.id AS user_id, 
            u.username AS user_name
            FROM vehicle v
            LEFT JOIN category c ON c.id = v.category_id
            LEFT JOIN review r ON  r.vehicle_id = v.id
            LEFT JOIN users u ON  r.user_id = u.id
            WHERE v.id = :id AND r.isArchived = 0;

DELIMITER &&
CREATE PROCEDURE createReservation(IN place VARCHAR(255),IN date DATE , IN user_id INT,IN vehicle_id INT)
BEGIN
    INSERT INTO reservation (place,date,user_id,vehicle_id) VALUES (place,date,user_id,vehicle_id);
END &&


CREATE TABLE theme (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    image TEXT,
    title VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE blog (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    image TEXT,
    video TEXT,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    user_id INT NOT NULL,
    theme_id INT NOT NULL,
    isPublished BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (theme_id) REFERENCES theme(id)
);

CREATE TABLE tag (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE blog_tag (
    blog_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (blog_id, tag_id),
    FOREIGN KEY (blog_id) REFERENCES blog(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE CASCADE
);

CREATE TABLE comment (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    body TEXT NOT NULL,
    user_id INT NOT NULL,
    blog_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (blog_id) REFERENCES blog(id) ON DELETE CASCADE
);

CREATE TABLE favorit (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    blog_id INT NOT NULL,
    UNIQUE(user_id, blog_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (blog_id) REFERENCES blog(id) ON DELETE CASCADE
);