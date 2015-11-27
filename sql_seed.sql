/*
    Seed file for 337 final project
*/

drop table if exists reviewers;
CREATE TABLE reviewers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_name varchar(64) NOT NULL default '',
password varchar(255) NOT NULL default ''
first_name varchar(64) NOT NULL default '',
last_name varchar(64) NOT NULL default '',
publication varchar(64) NOT NULL default ''
);


drop table if exists reviews;
CREATE TABLE reviews(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
movie_title varchar(64) NOT NULL default '',
review varchar(2000) NOT NULL default '',
author varchar(64) NOT NULL default '',
publication varchar(100) NOT NULL default ''
);

drop table if exists movies;
CREATE TABLE movies(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
author varchar(64) NOT NULL default '',
title varchar(64) NOT NULL default '',
freshness INT NOT NULL default 0,
director varchar(100) NOT NULL default '',
year INT NOT NULL default 0,
rating varchar(140) NOT NULL default '',
runtime INT NOT NULL default 0,
box_office INT NOT NULL default 0
);

insert into reviewers(reviewer, hashed_pwd) values 
    ('Christopher Walken', 'Anotherhashedpassword'),
    ('Kyle Walken', '4n0th3RH4SH3dp455w0rDz!'),
    ('Dave Farber', 'H4SH3dp455w0rDz!');
insert into reviews(movie_title, review, author) values 
    ('Senior Abnormal Samurai Chickens', 'More sweet, less sour, please.', 'Hungry Hippo'),
    ('Senior Abnormal Samurai Chickens', 'Obvious cash grab', 'Anemic Antlion'),
    ('Senior Abnormal Samurai Chickens', 'How about something original?', 'Distended Dingo'),
    ('Adolescent Cancerous Peasant Ducklings', 'Not as good as advertised', 'Bloated Python'),
    ('Teenage Mutant Ninja Turkeys', 'I guess I liked it, but I''m sure I''m hungry', 'Dave Farber');
insert into movies(title, freshness, director, year, rating, runtime, box_office) values 
    ('Senior Abnormal Samurai Chickens', 11, 'director 1', 1999, 'G', 0, 0),
    ('Adolescent Cancerous Peasant Ducklings', 22, 'director 2', 1999, 'PG', -12, -999999999),
    ('Teenage Mutant Ninja Turkeys', 33, 'director 3', 1999, 'NC-70', 999, 999999999);
