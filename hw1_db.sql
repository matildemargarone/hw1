CREATE DATABASE if NOT EXISTS hw1;
USE hw1;

CREATE TABLE if NOT EXISTS users (
   id integer primary key auto_increment,
   username varchar(16) not null unique,
   password varchar(255) not null,
   email varchar(255) not null unique,
   name varchar(255) not null,
   surname varchar(255) not null
);

CREATE TABLE if not exists favourites (
   id INT PRIMARY KEY AUTO_INCREMENT,
   userid INT NOT NULL,
   articleid INT NOT NULL,
   article_name VARCHAR(255) NOT NULL,
   article_src TEXT NOT NULL,
   UNIQUE KEY unique_favourite (userid, articleid)
);

